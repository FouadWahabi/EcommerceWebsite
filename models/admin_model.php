<?php

class admin_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function signIn($data) {
        $sth = $this->db->prepare('SELECT * FROM e_admin WHERE admin_username = :username AND admin_pass = :pswd');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':username' => $data['email'], ':pswd' => $data['pswd']));
        $user = $sth->fetchAll();
        if(count($user) > 0)
            return $user[0]['admin_id'];
        else
            return false;
    }
    
    public function getSalesByMarque() {
        $sth = $this->db->prepare('SELECT marque_name, SUM(COALESCE(product_qte, 0)) AS sum FROM e_marques m LEFT JOIN ( SELECT cp.product_qte, p.marque_id FROM e_command_products cp, e_products p WHERE cp.product_id = p.product_id ) x ON m.marque_id = x.marque_id GROUP BY marque_name');  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return json_encode($sth->fetchAll());
    }
    
    public function getGainStats() {
          $sth = $this->db->prepare("SELECT MONTHNAME(STR_TO_DATE(MONTH(command_date), '%m')) AS month, SUM(command_price) price FROM e_command GROUP BY MONTH(command_date)");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return json_encode($sth->fetchAll());
    }
    
    public function getTotalSales() {
        $sth = $this->db->prepare("SELECT SUM(command_price) AS total FROM e_command");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return json_encode($sth->fetchAll());
    }
    
    public function getWarnings() {
        $sth = $this->db->prepare("SELECT * FROM e_products WHERE product_stock < 10");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return json_encode($sth->fetchAll());
    }
    
    public function addToStock($id) {
        $sth = $this->db->prepare("UPDATE e_products SET product_stock = product_stock + :stock WHERE product_id = :id");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        return $sth->execute(array(':id' => $id, ':stock' => $_POST['stock']));
    }
    
    public function addProd($product_short_desc = false, $product_long_desc = false, $product_price = false, $product_stock = false, $product_qte = false, $product_ref = false, $product_thumb = false, $marque_name = false) {
        if($product_short_desc && $product_long_desc && $product_price && $product_stock && $product_qte && $product_ref && $product_thumb && $marque_name) {
            // test on marque
            $sth4 = $this->db->prepare("SELECT marque_id FROM e_marques WHERE marque_name = :marque_name");  
            $sth4->setFetchMode(PDO::FETCH_ASSOC);
            $sth4->execute(array(':marque_name' => $marque_name));
            $dat = $sth4->fetchAll();
            $marque_id = 0;
            if(count($dat) > 0) {
                $marque_id = $dat[0]['marque_id'];
            } else {
                $sth4 = $this->db->prepare("INSERT INTO e_marques (marque_name) VALUES (:marque_name)");  
                $sth4->setFetchMode(PDO::FETCH_ASSOC);
                $sth4->execute(array(':marque_name' => $marque_name));
                $marque_id = $this->db->lastInsertId();
            }
            
            $sth = $this->db->prepare('INSERT INTO e_products (marque_id, product_short_desc, product_long_desc, product_price, product_stock, product_qte, product_ref) VALUES (:marque_id, :product_short_desc, :product_long_desc, :product_price, :product_stock, :product_qte, :product_ref)');
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array(':product_short_desc' => $product_short_desc, ':product_long_desc' => $product_long_desc, ':product_price' => $product_price, ':product_stock' => $product_stock, ':product_qte' => $product_qte, ':product_ref' => $product_ref, ':marque_id' => $marque_id));
            $id = $this->db->lastInsertId('product_id');
            $target_file = "img/thumbs/art-" . $id ."-thumb.jpg";
            if(!move_uploaded_file($product_thumb, $target_file)) {
                $sth1 =  $this->db->prepare('DELETE FROM e_products WHERE product_id = :id');
                $sth1->setFetchMode(PDO::FETCH_ASSOC);
                $sth1->execute(array(':id' => $id));
            } else {
                $sth1 =  $this->db->prepare('UPDATE e_products SET product_thumb = "img/thumbs/art-' . $id . '-thumb.jpg" WHERE product_id = :id');
                $sth1->setFetchMode(PDO::FETCH_ASSOC);
                $sth1->execute(array(':id' => $id));
                $this->resize_image($target_file, 212, 169);
                Redirect(URL);
            }   
        }
    }
    
    
    public function validateCommand($id) {
        $sth = $this->db->prepare("UPDATE e_products SET product_stock = product_stock + :stock WHERE product_id = :id");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id, ':stock' => $_POST['stock']));
    }
    
    
    private function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }
    
    public function addPromo($id, $promo) {
        $sth = $this->db->prepare("UPDATE e_products SET product_solde = :product_solde WHERE product_id = :id");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id, ':product_solde' => $promo));
        Redirect(URL . 'product');
    }
    
}

?>
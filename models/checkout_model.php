<?php

class checkout_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function passCommand($price) {
        $panier = Session::get('panier');
        $ok = true;
        foreach($panier as &$val) {
            $sth1 = $this->db->prepare('SELECT * FROM e_products WHERE (product_stock - :qte) < 0 AND product_id = :id');
            $sth1->setFetchMode(PDO::FETCH_ASSOC);
            $sth1->execute(array(':qte' => $val['qte'], ':id' => $val['prod']));
            if(count($sth1->fetchAll()) > 0)
                $ok = false;
        }
        if($ok) {
            $sth = $this->db->prepare('INSERT INTO e_command (command_price, user_id) VALUES (:command_price, :user_id)');
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array(':command_price' => $price, ':user_id' => Session::get('user')));
            $id = $this->db->lastInsertId();

            $sth2 = $this->db->prepare('UPDATE e_users set user_pf = user_pf + :user_pf WHERE user_id = :user_id');
            $sth2->setFetchMode(PDO::FETCH_ASSOC);
            $sth2->execute(array(':user_pf' => $price, ':user_id' => Session::get('user')));

            foreach($panier as &$val) {
                $sth1 = $this->db->prepare('INSERT INTO  e_command_products (command_id, product_id, product_qte) VALUES (:command_id, :product_id, :product_qte)');
                $sth1->setFetchMode(PDO::FETCH_ASSOC);
                $sth1->execute(array(':command_id' => $id, ':product_id' => $val['prod'], ':product_qte' => $val['qte']));

                $sth3 = $this->db->prepare('UPDATE  e_products SET product_stock = product_stock - :product_qte WHERE product_id = :id');
                $sth3->setFetchMode(PDO::FETCH_ASSOC);
                $sth3->execute(array(':product_qte' => $val['qte'], ':id' => $val['prod']));
            }
            Session::destroySess('panier');
        } else  {
            echo 'error';
        }
    }
    
}

?>
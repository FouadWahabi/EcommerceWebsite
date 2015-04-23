<?php

class product_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // load all products
    public function loadProducts() {
        $sth = $this->db->prepare('SELECT * FROM e_products');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        foreach($data as $key => $el) {
            $data[$key]['product_thumb'] = URL . $data[$key]['product_thumb'];
            $data[$key]['product_image'] = URL . $data[$key]['product_image'];
            $data[$key]['product_update_date'] = date('d M y, j:ia', strtotime($data[$key]['product_update_date']));
        }
        return json_encode($data);
    }
    
    // load specififc product
    public function loadProduct($id) {
        $sth = $this->db->prepare('SELECT * FROM e_products p, e_vendors v WHERE p.product_id = :id AND v.vendor_id = p.vendor_id');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id));
        $data = $sth->fetchAll();
        foreach($data as $key => $el) {
            $data[$key]['product_thumb'] = URL . $data[$key]['product_thumb'];
            $data[$key]['product_image'] = URL . $data[$key]['product_image'];
            $data[$key]['product_update_date'] = date('d M y, j:ia', strtotime($data[$key]['product_update_date']));
        }
        return $data;
    }
    
}

?>
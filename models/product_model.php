<?php

class product_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // load all products
    public function loadProducts($page, $marque_list = false, $price = false) {

        if(!$marque_list) {
            $sth = $this->db->prepare("SELECT * FROM e_products p, e_marques v WHERE v.marque_id = p.marque_id" . ($price != false ? " AND p.product_price BETWEEN " . $price['min'] . " AND " . $price['max'] : "") . " ORDER BY p.product_id LIMIT " . (($page - 1) * 6) .", 6");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
        } else {
            $sth = $this->db->prepare("SELECT * FROM e_products p, e_marques v WHERE v.marque_id = p.marque_id " . ($price != false ? " AND p.product_price BETWEEN " . $price['min'] . " AND " . $price['max'] : "") . " AND v.marque_name IN ( $marque_list ) ORDER BY p.product_id LIMIT " . (($page - 1) * 6) . ", 6");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
        }
        $data = $sth->fetchAll();
        foreach($data as $key => $el) {
            $data[$key]['product_thumb'] = URL . $data[$key]['product_thumb'];
            $data[$key]['product_update_date'] = date('d M y, j:ia', strtotime($data[$key]['product_update_date']));
        }
        return json_encode($data);
    }
    
    public function pageNumber() {
        $sth = $this->db->prepare('SELECT (COUNT(p.product_id) / 6) + 1 AS pages FROM e_products p');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return (int)$data[0]['pages'];
    }
    
    // load specififc product
    public function loadProduct($id) {
        $sth = $this->db->prepare('SELECT * FROM e_products p, e_marques v WHERE p.product_id = :id AND v.marque_id = p.marque_id');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id));
        $data = $sth->fetchAll();
        foreach($data as $key => $el) {
            $data[$key]['product_thumb'] = URL . $data[$key]['product_thumb'];
            $data[$key]['product_update_date'] = date('d M y, j:ia', strtotime($data[$key]['product_update_date']));
        }
        return $data;
    }
    
    //load marques
    public function loadMarques() {
        $sth = $this->db->prepare('SELECT marque_name FROM e_marques');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return json_encode($data);
    }
    
    // max parice
    public function getMaxPrice() {
        $sth = $this->db->prepare('SELECT MAX(product_price) AS price FROM e_products p');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return (int)$data[0]['price'];
    }
    
}

?>
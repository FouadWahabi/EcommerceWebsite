<?php

class search_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function search($id) {
        $sth = $this->db->prepare('SELECT * FROM e_products p WHERE p.product_short_desc LIKE "%' . $id . '%"');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return json_encode($data);  
    }
}

?>
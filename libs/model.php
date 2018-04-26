<?php

class model {

    public  function __construct() {
        $this->db = new database();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
    }
}

?>

<?php

class admin_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function signIn($data) {
        $sth = $this->db->prepare('SELECT * FROM e_admin WHERE admin_username = :username AND admin_pass = :pswd');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($data);
        $user = $sth->fetchAll();
        if(count($user) > 0)
            return $user[0]['admin_id'];
        else
            return false;
    }
    
}

?>
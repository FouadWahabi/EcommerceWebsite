<?php

class register_model extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function isUserExists($email) {
        $sth = $this->db->prepare('SELECT * FROM e_users WHERE user_email = :email');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':email' => $email));
        $data = $sth->fetchAll();
        return (count($data) > 0 ? 'true' : 'false');
    }
    
    function user($id) {
        $sth = $this->db->prepare('SELECT * FROM e_users WHERE user_id = :id');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id));
        $data = $sth->fetchAll();
        return $data;
    }
    
    function addUser($data) {
        if($this->isUserExists($data['email-reg']) === 'false') {
            $sth = $this->db->prepare('INSERT INTO e_users (user_fname, user_lname, user_email, user_pswd, user_phone, user_city, user_state, user_zip, user_adress) VALUES (:first_name, :last_name, :email_reg, :password_reg, :phone, :city, :state, :zip, :adress)');
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array(':first_name' => $data['first_name'], ':last_name' => $data['last_name'], ':email_reg' => $data['email-reg'], ':password_reg' => $data['password-reg'], ':phone' => $data['phone'], ':city' => $data['city'], ':state' => $data['state'], ':zip' => $data['zip'], ':adress' => $data['adress']));
            Redirect(URL);
        } else {
            // handle error
        }
    }
    
    function signIn($data) {
           $sth = $this->db->prepare('SELECT * FROM e_users WHERE user_email = :email AND user_pswd = :pswd');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($data);
        $user = $sth->fetchAll();
        if(count($user) > 0)
            return $user[0]['user_id'];
        else
            return false;
    }
    
    function getUserPf($id) {
        $sth = $this->db->prepare('SELECT user_pf FROM e_users WHERE user_id = :id');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(':id' => $id));
        $data = $sth->fetchAll();
        return $data;
    }
    
}

?>
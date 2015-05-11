<?php
class register extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function displayView() {
        $this->view->js = array('register/js/default.js');
        $this->view->render('register/register');
    }
    
    function isUserExists($email = false) {
        if($email != false) {
             echo $this->model->isUserExists($email);
        }
    }
    
    function addUser() {
        if($this->isRegDataExists()) {
            $this->model->addUser(array('first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'email-reg' => $_POST['email-reg'], 'password-reg' => $_POST['password-reg'], 'phone' => $_POST['phone'], 'city' => $_POST['city'], 'state' => $_POST['state'], 'zip' => $_POST['zip'], 'adress' => $_POST['adress']));
        } else {
            // handle error
        }
    }
    
    private function isRegDataExists() {
        return isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email-reg']) && isset($_POST['password-reg']) && isset($_POST['phone']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['adress']);
    }
    
    private function isSignDataExists() {
        return isset($_POST['email-sign']) && isset($_POST['password-sign']);
    }
    
    // sign in
    
    function signIn() {
        if($this->isSignDataExists()) {
            $id = $this->model->signIn(array('email' => $_POST['email-sign'] , 'pswd' => $_POST['password-sign']));
            if($id) {
                Session::set('user', $id);
                print_r(Session::get('user'));
            }
           Redirect(URL);
        }
    }
    
    function signOut($id) {
        if(Session::get('user') == $id) {
            Session::destroySess('user');
        }
    }
    
    function getSession() {
        echo Session::get('user');
    }
    
    function getUserPf($id = false) {
        if($id) {
            $user = $this->model->getUserPf($id);
            echo $user[0]['user_pf'];
        }
    }
    
}

?>
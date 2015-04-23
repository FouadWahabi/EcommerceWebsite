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
        return isset($_POST['email-sign']) && isset($_POST['password_sign']);
    }
    
    // sign in
    
    function signIn() {
        if($this->isSignDataExists()) {
            $this->model->signIn(array('email-sign' => $_POST['email-sign'] , 'password_sign' => $_POST['password_sign']));
        }
    }
    
}

?>
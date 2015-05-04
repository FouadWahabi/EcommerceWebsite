<?php
class admin extends controller {
    
    function __construct() {
        parent::__construct();
        
    }
    
    function displayView() {
        $this->view->js = array('admin/js/default.js');
        $this->view->render('admin/admin');
    }
    
    private function isSignDataExists() {
        return isset($_POST['email-sign']) && isset($_POST['password-sign']);
    }
    
    function signIn() {
        if($this->isSignDataExists()) {
            $id = $this->model->signIn(array('email' => $_POST['email-sign'] , 'pswd' => $_POST['password-sign']));
            if($id) {
                Session::set('admin', $id);
            }
            Redirect(URL . 'admin');
        }
    }
}

?>
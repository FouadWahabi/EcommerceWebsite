<?php
class profile extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function displayView() {
        $this->view->js = array('profile/js/default.js');
        $this->view->render('profile/profile');
    }
    
}
?>
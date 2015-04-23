<?php
class product extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function displayView() {
        $this->view->js = array('product/js/default.js');
        $this->view->render('product/product');
    }
    
    public function ajaxLoadProds() {
        echo $this->model->loadProducts();
    }
    
    public function prod($id = false) {
        if(!($id === false)) {
            $this->view->data = array();
            $this->view->data = $this->model->loadProduct($id);
            $this->view->js = array('product/js/prod.js');
            $this->view->render('product/prod');
        } else {
            // error handler
        }
    }
}
?>
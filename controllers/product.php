<?php
class product extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function displayView() {
        $this->view->js = array('product/js/default.js');
        $this->view->render('product/product');
    }
    
    public function page($page) {
        if($this->isLoadDataExists()) {
            $marque_list = join(',',$_POST['marque_list']);
            if(isset($_POST['price'])) {
                $this->ajaxLoadProds($page, $marque_list, $_POST['price']);
            } else {
                $this->ajaxLoadProds($page, $marque_list);
            }
        } else {
            if(isset($_POST['price'])) {
                $this->ajaxLoadProds($page, false, $_POST['price']);
            } else {
                $this->ajaxLoadProds($page);
            }
        }
    }
    
    public function pageNumber() {
        print_r($this->model->pageNumber());   
    }
    
    private function ajaxLoadProds($page, $marque_list = false, $price = false) {
        echo $this->model->loadProducts($page, $marque_list, $price);
    }
    
    public function loadProduct($id = false) {
        if($id) {
            echo json_encode($this->model->loadProduct($id)); 
        }
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
    
    public function marque($marque = false) {
        if(!$marque) {
            echo $this->model->loadMarques();
        }
    }
    
    public function maxPrice() {
        echo $this->model->getMaxPrice();
    }
    
    private function isLoadDataExists() {
        return isset($_POST['marque_list']);
    }
}
?>
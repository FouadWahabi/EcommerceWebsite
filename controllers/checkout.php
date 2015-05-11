<?php
class checkout extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    public function displayView() {
        $this->view->js = array('checkout/js/default.js');
        $this->view->render('checkout/checkout');
    }
    
    public function addToBasket() {
        if($this->isDataExists()) {
            echo Session::add('panier', array('prod' => $_POST['prod'], 'qte' => $_POST['qte']));
        }
    }
    
    private function isDataExists() {
        return isset($_POST['prod']) && isset($_POST['qte']);
    }
    
    public function getBasketProds() {
        echo json_encode(Session::get('panier')) != 'null' ? json_encode(Session::get('panier')) : json_encode('');
    }
    
    public function removeFromBascket($id = false) {
        if($id) {
            Session::remove('panier', $id);
        }
    }
    
    public function checkout() {
        if(Session::get('user') && isset($_POST['total_price'])) {
            $this->view->js = array('checkout/js/check.js');
            $this->view->render('checkout/check');
        }
    }
    
    public function passCommand() {
        if(isset($_POST['total_price']) && Session::get('user')) {
            $this->model->passCommand($_POST['total_price']);
        } else
            echo 'error';
    }
}

?>
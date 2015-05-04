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
        echo json_encode(Session::get('panier'));
    }
    
    public function removeFromBascket($id = false) {
        if($id) {
            Session::remove('panier', $id);
        }
    }
    
    public function checkout() {
        echo 'hello every one';
    }
}

?>
<?php
class checkout extends controller {
    
    function __construct() {
        parent::__construct();
    }
    
    public function displayView() {
        
    }
    
    public function addToBasket($id) {
        Session::set('panier', $id);
    }
}

?>
<?php
class search extends controller {
    
    function __construct() {
        parent::__construct();
        
    }
    
    public function search($key = false) {
        if($key) {
            echo $this->model->search($key);
        }
    }
}

?>
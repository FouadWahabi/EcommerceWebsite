<?php

class controller {
    
    function __construct() {
        $this->view = new view();
        $this->view->js = array();
    }
    
    public function loadModel($name) {
        $path = 'models/' . $name . '_model.php';
        if(file_exists($path)) {
            require $path;
            $modelName = $name . '_model';
            $this->model = new $modelName();
        }
    }
    
}

?>
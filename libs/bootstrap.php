<?php

class Bootstrap {

    function __construct() {

        $controller = null;
        $url = substr($_SERVER["REQUEST_URI"], 1);
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // determine controller
        if(empty($url[0])) { // select default index controller
            require 'controllers/product.php';
            $controller = new product();
            $controller->displayView();
            return false;
        }
        // not deafult controller
        $file = 'controllers/' . $url[0] . '.php';
        if(file_exists($file)) {
            require $file;
            // instantiate controller
            $controller = new $url[0];
            // load model
            $controller->loadModel($url[0]);
            if(isset($url[1])) { // determine method
                if(method_exists($controller, $url[1])) {
                       if(isset($url[2])) { // determine args
                            $controller->{$url[1]}($url[2]);
                       } else {
                            $res = $controller->{$url[1]}();
                            echo $res;
                            die();
                       }
                } else {
                    echo 'Error method not exists<br>';
                    // handle method inexistence
                }
            } else {
                 $controller->{'displayView'}();
            }
        } else {
            echo 'Error file not exists<br>';
            // handle controller inexistance
        }


    }

}

?>

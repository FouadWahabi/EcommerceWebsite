<?php
class admin extends controller {
    
    function __construct() {
        parent::__construct();
        
    }
    
    function displayView() {
        $this->view->js = array('admin/js/default.js');
        if(!Session::get('admin')) {
            $this->view->render('admin/admin');
        } else {
            $this->view->render('admin/manager');
        }
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
    
        
    public function getSalesByMarque() {
        echo $this->model->getSalesByMarque();   
    }
    
    public function getGainStats() {
        echo $this->model->getGainStats();   
    }
    
    public function getTotalSales() {
        echo $this->model->getTotalSales();   
    }
    
    public function getWarnings() {
        echo $this->model->getWarnings();
    }
    
    public function addToStock($id) {
        echo $this->model->addToStock($id);
    }
    
    public function addProd() {
        $target_dir = URL . "img/thumbs"; 
        $target_file = $target_dir . basename($_FILES["product_thumb"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $uploadOk = 0;
        
        if(!isset($_POST["submit"])) {
            $check = getimagesize($_FILES["product_thumb"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            $this->model->addProd($_POST['prod_short_desc'], $_POST['prod_long_desc'], $_POST['product_price'], $_POST['product_stock'], $_POST['product_qte'], $_POST['product_ref'], $_FILES["product_thumb"]["tmp_name"], $_POST['marque_name']);
        }
        
    }
    
    public function validateCommand($id) {
        $this->model->validateCommand($id);
    }
    
    public function getCommands() {
        echo $this->model->getCommands();   
    }
    
    public function disconnect() {
        Session::destroySess('admin');
        Redirect(URL . 'admin');
    }
    
    public function addPromo() {
        $this->model->addPromo($_POST['id'], $_POST['promo']);   
    }
    
}

?>
<?php
require __DIR__ . "/../models/forgot.php";

class ForgotController{
    private $model;

    public function __construct($pdo){
        $this->model = new ForgotModel($pdo);
    }

    public function contact(){
        require __DIR__ . "/../views/forgot.php";
    }
}

?>
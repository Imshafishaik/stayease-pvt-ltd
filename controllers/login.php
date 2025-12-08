<?php
require __DIR__ . "/../models/login.php";

class LoginController{
    private $model;

    public function __construct($pdo){
        $this->model = new LoginModel($pdo);
    }

    public function login(){
        require __DIR__ . "/../views/login.php";
    }
}
?>
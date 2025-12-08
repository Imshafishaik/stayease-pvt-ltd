<?php
require __DIR__ . "/../models/signup.php";

class SignupController{
    private $model;

    // public class __construct($pdo){
    //     $this->model = new SignupModel($pdo);
    // }

    public function signup(){
        require __DIR__ . "/../views/signup.php";
    }
}

?>
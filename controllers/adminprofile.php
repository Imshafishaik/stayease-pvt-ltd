<?php
require __DIR__ . "/../models/adminprofile.php";

class AdminprofileController{
    private $model;

    public function __construct($pdo){
        $this->model = new AdminprofileModel($pdo);
    }

    public function adminprofile(){
        require __DIR__ . "/../views/adminprofile.php";
    }
}

?>
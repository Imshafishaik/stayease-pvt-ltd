<?php
require __DIR__ . "/../models/admin.php";

class AdminController{
    private $model;

    public function __construct($pdo){
        $this->model = new AdminModel($pdo);
    }

    public function admin(){
        require __DIR__ . "/../views/admin.php";
    }
}
?>
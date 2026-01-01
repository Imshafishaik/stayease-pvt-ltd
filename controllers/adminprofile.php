<?php
require __DIR__ . "/../models/adminprofile.php";

class AdminprofileController{
    private $model;

    public function __construct($pdo){
        $this->model = new AdminprofileModel($pdo);
    }

    public function adminprofile(){
        $students_admin = $this->model->studentVerify();
        $owner_admin = $this->model->ownerVerify();
        require __DIR__ . "/../views/adminprofile.php";
    }
}

?>
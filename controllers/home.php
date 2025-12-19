<?php
require __DIR__ . "/../models/home.php";

class HomeController{
    private $model;

    public function __construct($pdo){
        $this->model = new HomeModel($pdo);
    }

    public function home(){
        $accommodations = $this->model->getTopListingAll();
        require __DIR__ . "/../views/home.php";
    }
}

?>
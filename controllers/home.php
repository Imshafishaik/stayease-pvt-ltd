<?php
require __DIR__ . "/../models/home.php";

class HomeController{
    private $model;

    public function __construct($pdo){
        $this->model = new HomeModel($pdo);
    }

    public function home(){
        $topListings = $this->model->getTopListingsByReviews(6);
        require __DIR__ . "/../views/home.php";
    }

    
}

?>
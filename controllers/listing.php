<?php
require __DIR__ . "/../models/listing.php";

class ListingController{
    private $model;

    public function __construct($pdo){
        $this->model = new ListingModel($pdo);
    }

    public function listing(){
        require __DIR__ . "/../views/listing.php";
    }
}

?>
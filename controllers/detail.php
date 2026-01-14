<?php
require __DIR__ . "/../models/detail.php";

class AccomodationDetailController{
    private $model;

    public function __construct($pdo){
        $this->model = new DetailModel($pdo);
    }

    
}

?>
<?php
require __DIR__ . "/../models/rentupload.php";

class RentuploadController{
    private $model;

    public function __construct($pdo){
        $this->model = new RentuploadModel($pdo);
    }
    
    public function rentupload(){
        require __DIR__ . "/../views/rentupload.php";
    }

    }

?>
<?php
require __DIR__ . "/../models/owner.php";

class OwnersController{
    private $model;

    public function __construct($pdo){
        $this->model = new OwnersModel($pdo);
    }

    public function owner(){
        require __DIR__ . "/../views/ownerlisting.php";
    }
}
?>
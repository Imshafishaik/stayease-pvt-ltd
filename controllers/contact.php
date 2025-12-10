<?php
require __DIR__ . "/../models/contact.php";

class ContactController{
    private $model;

    public function __construct($pdo){
        $this->model = new ContactModel($pdo);
    }

    public function contact(){
        require __DIR__ . "/../views/contact.php";
    }
}

?>
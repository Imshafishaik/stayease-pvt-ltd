<?php

    class RentuploadModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
    }

?>
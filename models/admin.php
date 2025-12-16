<?php

    class AdminModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
    }

?>
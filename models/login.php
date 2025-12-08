<?php

    class LoginModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
    }

?>
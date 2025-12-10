<?php

    class OwnersModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
    }

?>
<?php

    class AdminprofileModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function studentVerify(): ?array {
        $sql = "
            SELECT 
                    user_id, 
                    user_name, 
                    user_email, 
                    user_doc_one, 
                    user_doc_two
                FROM users
                WHERE user_type = 'student' 
                AND user_check = 'FALSE';
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public function ownerVerify(): ?array {
            $sql = "
            SELECT 
                    user_id, 
                    user_name, 
                    user_email, 
                    user_doc_one, 
                    user_doc_two
                FROM users
                WHERE user_type = 'owner' 
                AND user_check = 'FALSE';
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>
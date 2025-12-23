<?php

    class ListingModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getAll() {
        $sql = "
            SELECT 
                a.accommodation_id,
                a.accommodation_name,
                a.accommodation_description,
                a.accommodation_price,
                a.accommodation_available,
                d.photo_img
            FROM accommodation a
            LEFT JOIN documents d 
                ON a.accommodation_id = d.accommodation_id
            ORDER BY a.accommodation_id DESC
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>
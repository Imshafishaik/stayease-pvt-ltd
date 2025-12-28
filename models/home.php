<?php

    class HomeModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getTopListingsByReviews(int $limit = 6): array {
    $sql = "
        SELECT
            a.accommodation_id,
            a.accommodation_name,
            a.accommodation_price,
            COUNT(ar.review_id) AS total_reviews,
            COALESCE(AVG(ar.rating), 0) AS avg_rating,
            MIN(d.photo_img) AS photo_img
        FROM accommodation a
        LEFT JOIN accommodation_reviews ar
            ON a.accommodation_id = ar.accommodation_id
        LEFT JOIN documents d
            ON a.accommodation_id = d.accommodation_id
        GROUP BY a.accommodation_id
        ORDER BY total_reviews DESC
        LIMIT :limit
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    }

?>
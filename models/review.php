<?php
class ReviewModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addReview($accommodationId, $userId, $rating, $review) {
        $sql = "
            INSERT INTO accommodation_reviews 
            (accommodation_id, user_id, rating, review_text)
            VALUES (?, ?, ?, ?)
            ON CONFLICT (accommodation_id, user_id)
            DO UPDATE SET rating = EXCLUDED.rating,
                          review_text = EXCLUDED.review_text
        ";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$accommodationId, $userId, $rating, $review]);
    }

    public function getByAccommodation($accommodationId) {
        $sql = "
            SELECT r.*, u.user_name
            FROM accommodation_reviews r
            JOIN users u ON r.user_id = u.user_id
            WHERE r.accommodation_id = ?
            ORDER BY r.created_at DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$accommodationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($accommodationId) {
        $stmt = $this->pdo->prepare(
            "SELECT ROUND(AVG(rating),1) FROM accommodation_reviews WHERE accommodation_id = ?"
        );
        $stmt->execute([$accommodationId]);
        return $stmt->fetchColumn();
    }
}

?>
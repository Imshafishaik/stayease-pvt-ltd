
<?php
    class DetailModel {
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function getAccommodation(int $id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM accommodation WHERE accommodation_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getImages(int $id) {
        $stmt = $this->pdo->prepare("
            SELECT photo_img FROM documents WHERE accommodation_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getReviews($accommodationId) {
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

}
?>
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

    // public function getFaqs(int $id) {
    //     $stmt = $this->pdo->prepare("
    //         SELECT question, answer FROM faqs WHERE accommodation_id = ?
    //     ");
    //     $stmt->execute([$id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getReviews(int $id) {
    //     $stmt = $this->pdo->prepare("
    //         SELECT r.rating, r.comment, r.created_at, u.name
    //         FROM reviews r
    //         JOIN users u ON u.user_id = r.user_id
    //         WHERE r.accommodation_id = ?
    //         ORDER BY r.created_at DESC
    //     ");
    //     $stmt->execute([$id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}


?>
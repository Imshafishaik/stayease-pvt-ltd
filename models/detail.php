
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

}
?>
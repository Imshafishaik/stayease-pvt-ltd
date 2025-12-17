<?php
class OwnersModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getByOwner(int $userId): array {
        $sql = "
            SELECT 
                a.accommodation_id,
                a.accommodation_name,
                a.accommodation_description,
                a.accommodation_price,
                a.accommodation_available,
                MIN(d.photo_img) AS photo_img
            FROM accommodation a
            JOIN users u ON a.renter_id = u.user_id
            LEFT JOIN documents d ON a.accommodation_id = d.accommodation_id
            WHERE u.user_type = 'House Owner'
              AND u.user_id = :user_id
            GROUP BY a.accommodation_id
            ORDER BY a.accommodation_id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

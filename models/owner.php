<?php
class OwnersModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getOwnerInfo(int $userId): array {
        $sql = "
            SELECT 
                u.user_name,
                COUNT(a.accommodation_id) AS house_count
            FROM users u
            LEFT JOIN accommodation a ON a.renter_id = u.user_id
            WHERE u.user_id = :user_id
            GROUP BY u.user_name
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $owner = $stmt->fetch(PDO::FETCH_ASSOC);

        // Provide defaults if no data found
        return [
            'user_name' => $owner['user_name'] ?? 'Owner',
            'house_count' => $owner['house_count'] ?? 0
        ];
    }

    public function getByOwner(int $userId): array {
    $sql = "
        SELECT 
            a.accommodation_id,
            a.accommodation_name,
            a.accommodation_description,
            a.accommodation_price,
            a.accommodation_available,
            MIN(d.photo_img) AS photo_img,
            l.name AS location_name,
            l.city,
            l.state,
            l.country,
            l.pincode
        FROM accommodation a
        JOIN users u ON a.renter_id = u.user_id
        LEFT JOIN documents d ON a.accommodation_id = d.accommodation_id
        INNER JOIN locations l ON a.location_id = l.location_id
        WHERE u.user_type = 'owner'
          AND u.user_id = :user_id
        GROUP BY a.accommodation_id, l.location_id
        ORDER BY a.accommodation_id DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

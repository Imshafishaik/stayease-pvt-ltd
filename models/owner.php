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

 

public function getByOwnerPaginated(int $userId, int $limit, int $offset): array {
    $sql = "
        SELECT 
    a.accommodation_id,
    a.accommodation_name,
    a.accommodation_description,
    a.accommodation_price,
    a.accommodation_available,

    l.name    AS location_name,
    l.city,
    l.state,
    l.country,
    l.pincode,

    MIN(d.photo_img) AS photo_img

FROM accommodation a
INNER JOIN locations l 
    ON a.location_id = l.location_id
LEFT JOIN documents d 
    ON d.accommodation_id = a.accommodation_id

WHERE a.renter_id = :user_id

GROUP BY 
    a.accommodation_id,
    a.accommodation_name,
    a.accommodation_description,
    a.accommodation_price,
    a.accommodation_available,
    l.name,
    l.city,
    l.state,
    l.country,
    l.pincode

ORDER BY a.accommodation_id DESC
LIMIT :limit OFFSET :offset;

    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function countByOwner(int $userId): int {
    $sql = "
        SELECT COUNT(*) 
        FROM accommodation 
        WHERE renter_id = :user_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    return (int) $stmt->fetchColumn();
}


}

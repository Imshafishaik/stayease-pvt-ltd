<?php

class FavouriteModel {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addToFavourites(int $userId, int $accommodationId): bool {

        $sql = "
            INSERT INTO favourites (user_id, accommodation_id)
            VALUES (:user_id, :accommodation_id)
            ON CONFLICT (user_id, accommodation_id) DO NOTHING
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'accommodation_id' => $accommodationId
        ]);

        return $stmt->rowCount() > 0;
    }

    public function getUserFavourites(int $userId, int $limit, int $offset): array
    {
        $sql = "
            SELECT 
                a.accommodation_id,
                a.accommodation_name,
                a.accommodation_description,
                a.accommodation_price,
                a.accommodation_available,

                l.city,
                l.state,
                l.country,

                MIN(d.photo_img) AS photo_img

            FROM favourites f
            JOIN accommodation a ON a.accommodation_id = f.accommodation_id
            JOIN locations l ON a.location_id = l.location_id
            LEFT JOIN documents d ON d.accommodation_id = a.accommodation_id

            WHERE f.user_id = :user_id

            GROUP BY a.accommodation_id, l.location_id
            ORDER BY MAX(f.created_at) DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUserFavourites(int $userId): int
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM favourites WHERE user_id = ?"
        );
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }

}



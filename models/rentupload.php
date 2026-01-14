<?php

class RentuploadModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertLocation(
    string $name,
    string $city,
    string $state,
    string $country,
    ?string $pincode
): int {
    $sql = "
        INSERT INTO locations
        (name, city, state, country, pincode)
        VALUES (?, ?, ?, ?, ?)
        RETURNING location_id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        $name,
        $city,
        $state,
        $country,
        $pincode
    ]);

    return (int) $stmt->fetchColumn();
}

    public function insertAccommodation(
    string $name,
    string $description,
    float $price,
    int $furnished,
    int $available,
    int $renterId,
    int $locationId
): int {
    $sql = "
        INSERT INTO accommodation
        (accommodation_name, accommodation_description, accommodation_price,
         accommodation_is_furnished, accommodation_available, renter_id, location_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        RETURNING accommodation_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        $name,
        $description,
        $price,
        $furnished,
        $available,
        $renterId,
        $locationId
    ]);

    return (int) $stmt->fetchColumn();
}


    public function insertDocument(
        string $image,
        int $renterId,
        int $accommodationId
    ): void {
        $sql = "
            INSERT INTO documents (
                photo_img,
                renter_id,
                accommodation_id
            )
            VALUES (?, ?, ?)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $image,
            $renterId,
            $accommodationId
        ]);
    }
}

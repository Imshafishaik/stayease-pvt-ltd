

<?php

class RentuploadModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertAccommodation(
        string $name,
        string $description,
        string $address,
        float $price,
        bool $furnished,
        bool $available,
        int $renterId
    ) {
        $stmt = $this->pdo->prepare("
            INSERT INTO accommodation (
                accommodation_name,
                accommodation_description,
                accommodation_address,
                accommodation_price,
                accommodation_is_furnished,
                accommodation_available,
                renter_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $name,
            $description,
            $address,
            $price,
            $furnished,
            $available,
            $renterId
        ]);
    }

    // Insert image
    public function insertDocument(string $image, int $renterId) {
        $stmt = $this->pdo->prepare("
            INSERT INTO documents (photo_img, renter_id)
            VALUES (?, ?)
        ");

        $stmt->execute([$image, $renterId]);
    }

    // public function insertAccommodation(
    //     string $name,
    //     string $description,
    //     string $address,
    //     float $price,
    //     bool $furnished,
    //     bool $available,
    //     ?string $image,
    //     int $renterId
    // ) {
    //     $stmt = $this->pdo->prepare("
    //         INSERT INTO accommodation (
    //             accommodation_name,
    //             accommodation_description,
    //             accommodation_address,
    //             accommodation_price,
    //             accommodation_is_furnished,
    //             accommodation_available,
    //             accommodation_image,
    //             renter_id
    //         )
    //         VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    //     ");

    //     $stmt->execute([
    //         $name,
    //         $description,
    //         $address,
    //         $price,
    //         $furnished,
    //         $available,
    //         $image,
    //         $renterId
    //     ]);
    // }
}

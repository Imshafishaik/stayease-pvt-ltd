<?php 

class RentuploadModel { 
    private PDO $pdo; 
    public function __construct(PDO $pdo) { 
        $this->pdo = $pdo;
     } 
     public function insertAccommodation( string $name, string $description, string $address, float $price, bool $furnished, bool $available, int $renterId ):int { $sql = "INSERT INTO accommodation ( accommodation_name, accommodation_description, accommodation_address, accommodation_price, accommodation_is_furnished, accommodation_available, renter_id ) VALUES (?, ?, ?, ?, ?, ?, ?) RETURNING accommodation_id "; $stmt = $this->pdo->prepare($sql); $stmt->execute([ $name, $description, $address, $price, $furnished, $available, $renterId ]); return (int) $stmt->fetchColumn(); } 
     public function insertDocument(string $image, int $renterId,int $accommodationId):void { $sql = " INSERT INTO documents (photo_img, renter_id,accommodation_id) VALUES (?, ?, ?) "; $stmt = $this->pdo->prepare($sql); $stmt->execute([$image, $renterId,$accommodationId]); } }
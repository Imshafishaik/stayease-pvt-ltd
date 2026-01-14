<?php

class OrderModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Create order
    public function createOrder(int $userId, int $accommodationId): bool {

        $stmt = $this->pdo->prepare("
            SELECT accommodation_price
            FROM accommodation
            WHERE accommodation_id = ?
        ");
        $stmt->execute([$accommodationId]);
        $price = $stmt->fetchColumn();

        if (!$price) {
            throw new Exception('Invalid accommodation');
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO orders (user_id, accommodation_id, order_status, total_price)
            VALUES (?, ?, 'pending', ?)
        ");

        return $stmt->execute([$userId, $accommodationId, $price]);
    }



    // Orders for logged-in user
    public function getByUser($userId) {
        $sql = "
            SELECT o.*, a.accommodation_name
            FROM orders o
            JOIN accommodation a ON o.accommodation_id = a.accommodation_id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Orders for owner (their accommodations)
    public function getByOwner($ownerId) {
        $sql = "
            SELECT o.*, u.user_name, a.accommodation_name
            FROM orders o
            JOIN accommodation a ON o.accommodation_id = a.accommodation_id
            JOIN users u ON o.user_id = u.user_id
            WHERE a.renter_id = ?
            ORDER BY o.created_at DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ownerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update status
    public function updateStatus($orderId, $status) {
        $stmt = $this->pdo->prepare(
            "UPDATE orders SET order_status = ? WHERE order_id = ?"
        );
        return $stmt->execute([$status, $orderId]);
    }

    public function getOwnerRequests(int $userId) {
    $sql = "
        SELECT o.order_id, u.user_name, u.user_email,
               u.user_doc_one, u.user_doc_two,
               a.accommodation_name,
               o.total_price, o.order_status
        FROM orders o
        JOIN users u ON o.user_id = u.user_id
        JOIN accommodation a ON o.accommodation_id = a.accommodation_id
        WHERE a.renter_id = ?
          AND o.order_status = 'pending'
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getOrderWithEmails($orderId) {
    $sql = "
        SELECT 
            su.user_email AS student_email,
            ou.user_email AS owner_email
        FROM orders o
        JOIN users su ON o.user_id = su.user_id
        JOIN accommodation a ON o.accommodation_id = a.accommodation_id
        JOIN users ou ON a.renter_id = ou.user_id
        WHERE o.order_id = ?
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$orderId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    

}

?>

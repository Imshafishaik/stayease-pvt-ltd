<?php

    class LoginModel{

        private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("
            SELECT user_id, user_name, user_password, user_type
            FROM users
            WHERE user_email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    }

?>
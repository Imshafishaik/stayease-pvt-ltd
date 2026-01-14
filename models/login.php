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

    public function getUserById(string $userId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT user_id, user_name, user_password, user_type
            FROM users
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function saveResetToken(int $userId, string $token, string $expires): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO password_resets (user_id, token, expires_at)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$userId, $token, $expires]);
    }

    }

    

?>
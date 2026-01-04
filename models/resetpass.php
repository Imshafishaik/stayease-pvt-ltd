<?php
class PasswordResetModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Validate token and return user ID
    public function validateToken(string $token): ?int {
        $stmt = $this->pdo->prepare("SELECT user_id, expires_at FROM password_resets WHERE token = ? LIMIT 1");
        $stmt->execute([$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        if (strtotime($row['expires_at']) < time()) {
            $this->deleteToken($token);
            return null;
        }

        return (int)$row['user_id'];
    }

    // Update user's password
    public function updatePassword(int $userId, string $password): void {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");
        $stmt->execute([$hashed, $userId]);
    }

    // Delete token after use or expiry
    public function deleteToken(string $token): void {
        $stmt = $this->pdo->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->execute([$token]);
    }

    // Optional: remove all expired tokens
    public function cleanupExpiredTokens(): void {
        $stmt = $this->pdo->prepare("DELETE FROM password_resets WHERE expires_at < NOW()");
        $stmt->execute();
    }
}

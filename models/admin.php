<?php
class AdminModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Register new admin
    public function register(string $name, string $email, string $password): bool {
        $stmt = $this->pdo->prepare("SELECT admin_id FROM WebsiteAdmin WHERE admin_email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) return false; // email exists

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO WebsiteAdmin (admin_name, admin_email, admin_password) VALUES (:name, :email, :password)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashed
        ]);
    }

    // Login admin
    public function login(string $email, string $password): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM WebsiteAdmin WHERE admin_email = :email");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['admin_password'])) {
            return $admin;
        }
        return null;
    }
}
?>

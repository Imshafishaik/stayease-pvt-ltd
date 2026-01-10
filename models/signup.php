<?php

class SignupModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function emailExists(string $email): bool {
        $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->execute([$email]);
        return (bool) $stmt->fetch();
    }

    public function insertUser(
        string $name,
        string $email,
        string $password,
        string $userType,
        ?string $docOne,
        ?string $docTwo,
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (
            user_name, user_email, user_password,
            user_type, user_doc_one, user_doc_two,
            user_check, terms_accepted, terms_accepted_at
            ) VALUES (?, ?, ?, ?, ?, ?, false, true, NOW())");

        return $stmt->execute([
            $name,
            $email,
            $password,
            $userType,
            $docOne,
            $docTwo
        ]);
    }
}

<?php

    class UserModel{

        private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("
            SELECT user_id, user_name, user_email, user_password, user_type, user_doc_one, user_doc_two
            FROM users
            WHERE user_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    }

?>
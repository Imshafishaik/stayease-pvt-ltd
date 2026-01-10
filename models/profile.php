<?php

class ProfileModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getUser(int $id): array {
        $stmt = $this->pdo->prepare("
            SELECT user_id, user_name, user_email, user_type, user_doc_one, user_doc_two,user_check
            FROM users
            WHERE user_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser(
        int $id,
        string $name,
        ?string $password,
        ?string $docOne,
        ?string $docTwo
    ): void {
        $stmt = $this->pdo->prepare("
            UPDATE users SET
                user_name = :name,
                user_password = COALESCE(:password, user_password),
                user_doc_one = COALESCE(:doc1, user_doc_one),
                user_doc_two = COALESCE(:doc2, user_doc_two),
                user_check = false
            WHERE user_id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'password' => $password,
            'doc1' => $docOne,
            'doc2' => $docTwo
        ]);
    }
}

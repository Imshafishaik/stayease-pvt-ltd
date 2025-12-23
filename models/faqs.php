<?php
class FAQModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllFaqs(): array {
        $stmt = $this->pdo->query("
            SELECT question, answer
            FROM faqs
            ORDER BY faq_id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addQuestion(int $userId, string $question): void {
        $stmt = $this->pdo->prepare("
            INSERT INTO faqs (user_id, question)
            VALUES (?, ?)
        ");
        $stmt->execute([$userId, $question]);
    }

    public function answerQuestion(int $faqId, int $userId, string $answer): void {
        $stmt = $this->pdo->prepare("
            UPDATE faqs
            SET answer = ?, answered_by = ?, answered_at = NOW()
            WHERE faq_id = ?
        ");
        $stmt->execute([$answer, $userId, $faqId]);
    }
}
?>
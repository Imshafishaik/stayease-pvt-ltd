    <?php

    class AdminFaqModel {
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        // Get all unanswered FAQs
        public function getUnanswered(): array {
            $sql = "
                SELECT faq_id, question,answer
                FROM faqs
                ORDER BY faq_id DESC
            ";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        // Answer a FAQ
        public function answerFaq(int $faqId, string $answer, int $adminId): bool {
            $sql = "
                UPDATE faqs
                SET 
                    answer = :answer,
                    answered_by = :answered_by,
                    answered_at = NOW()
                WHERE faq_id = :faq_id
            ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':answer' => $answer,
            ':answered_by' => $adminId,
            ':faq_id' => $faqId
        ]);
        }

    }

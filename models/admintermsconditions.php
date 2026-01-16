<?php

    class AdmintermsconditionsModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getTerms(): string {
        $stmt = $this->pdo->query(
            "SELECT content FROM terms_conditions WHERE id = 1"
        );
        return $stmt->fetchColumn();
    }

    public function updateTerms(string $content): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE terms_conditions
            SET content = ?, updated_at = NOW()
            WHERE id = 1"
        );
        return $stmt->execute([$content]);
    }
    }
?>
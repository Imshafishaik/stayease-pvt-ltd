<?php
require __DIR__ . "/../models/faqs.php";

class FAQController {
    private FAQModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new FAQModel($pdo);
    }

    public function faq() {
        $faqs = $this->model->getAllFaqs();
        require __DIR__ . "/../views/faqs.php";
    }

    public function postQuestion() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo "Unauthorized";
            exit;
        }

        $question = trim($_POST['question'] ?? '');
        if ($question === '') {
            echo "Question cannot be empty";
            exit;
        }

        $this->model->addQuestion($_SESSION['user_id'], $question);
        header("Location: /index.php?action=faqs");
    }

    public function postAnswer() {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'House Owner') {
            http_response_code(403);
            echo "Unauthorized";
            exit;
        }

        $faqId  = (int)$_POST['faq_id'];
        $answer = trim($_POST['answer'] ?? '');

        if ($answer === '') {
            echo "Answer required";
            exit;
        }

        $this->model->answerQuestion($faqId, $_SESSION['user_id'], $answer);
        header("Location: /index.php?action=faqs");
    }
}
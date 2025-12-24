<?php
require __DIR__ . "/../models/adminfaq.php";

class AdminFaqController {
    private AdminFaqModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new AdminFaqModel($pdo);
    }

    // Show FAQ management page
    public function adminfaq() {
        session_start();

        // if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
        //     header("Location: /index.php?action=login");
        //     exit;
        // }

        $faqs = $this->model->getUnanswered();
        require __DIR__ . "/../views/adminfaq.php";
    }

    // Handle answering FAQ
    public function answer() {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            exit;
        }

        $faqId  = (int) $_POST['faq_id'];
        $answer = trim($_POST['answer']);

        if ($answer === '') {
            echo json_encode(['status' => 'error', 'message' => 'Answer required']);
            exit;
        }

        $this->model->answerFaq($faqId, $answer, $_SESSION['user_id']);

        echo json_encode(['status' => 'success']);
    }
}

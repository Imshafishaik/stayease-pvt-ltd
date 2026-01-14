<?php
require_once __DIR__ . "/../models/login.php"; // For user access
require __DIR__ . "/../models/resetpass.php"; // Reset-specific model

class PasswordResetController {
    private PasswordResetModel $model;
    private LoginModel $loginModel;

    public function __construct(PDO $pdo) {
        $this->model = new PasswordResetModel($pdo);
        $this->loginModel = new LoginModel($pdo);
    }

    // Display reset password form
    public function resetPage() {
        $token = $_GET['token'] ?? null;
        if (!$token) {
            echo "Invalid reset link";
            exit;
        }

        $userId = $this->model->validateToken($token);
        if (!$userId) {
            echo "Token expired or invalid";
            exit;
        }

        require __DIR__ . "/../views/resetpass.php";
    }

    // Handle reset submission
    public function reset() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');

        $token    = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm'] ?? '';

        if (!$token || !$password || !$confirm) {
            echo json_encode(['status' => 'error', 'message' => 'All fields required']);
            exit;
        }

        if ($password !== $confirm) {
            echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
            exit;
        }

        if (strlen($password) < 8) {
            echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters']);
            exit;
        }

        $userId = $this->model->validateToken($token);
        if (!$userId) {
            echo json_encode(['status' => 'error', 'message' => 'Token expired or invalid']);
            exit;
        }

        $this->model->updatePassword($userId, $password);
        $this->model->deleteToken($token);

        // Auto-login
        $user = $this->loginModel->getUserById($userId);
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_type'] = $user['user_type'];

        echo json_encode(['status' => 'success', 'message' => 'Password reset successfully']);
        exit;
    }
}

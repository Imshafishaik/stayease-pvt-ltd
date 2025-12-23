<?php
require __DIR__ . "/../models/login.php";

class LoginController {
    private LoginModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new LoginModel($pdo);
    }

    public function loginpage(){
        require __DIR__ . "/../views/login.php";
    }

    public function login() {
        // Clear any previous output
        if (ob_get_length()) ob_clean();

        // Always JSON
        header('Content-Type: application/json; charset=utf-8');

        try {
            // Only POST allowed
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo json_encode([
                    "status" => "error",
                    "message" => "Method not allowed"
                ]);
                exit;
            }

            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                echo json_encode([
                    "status" => "error",
                    "message" => "Email and password required"
                ]);
                exit;
            }

            // Fetch user
            $user = $this->model->getUserByEmail($email);

            if (!$user) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Invalid email or password"
                ]);
                exit;
            }

            // Verify password
            if (!password_verify($password, $user['user_password'])) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Invalid email or password"
                ]);
                exit;
            }

            // ✅ Start session safely
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_type'] = $user['user_type'];

            echo json_encode([
                "status" => "success",
                "message" => "Login successful"
            ]);
            exit;

        } catch (PDOException $e) {
            // Do NOT output error directly
            error_log($e->getMessage());
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Server error"
            ]);
            exit;
        } catch (Throwable $e) {
            error_log($e->getMessage());
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Unexpected error"
            ]);
            exit;
        }
    }
}

<?php
require __DIR__ . '/../models/admin.php';

class AdminController {
    private AdminModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new AdminModel($pdo);
    }

    public function adminRegister() {
        header('Content-Type: application/json');
        $name = trim($_POST['admin_name'] ?? '');
        $email = trim($_POST['admin_email'] ?? '');
        $password = $_POST['admin_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }
        if ($password !== $confirm) {
            echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
            exit;
        }
        if (!$this->model->register($name, $email, $password)) {
            echo json_encode(['status' => 'error', 'message' => 'Email already registered.']);
            exit;
        }

        echo json_encode(['status' => 'success', 'message' => 'Registration successful! Please login.']);
    }

    public function adminLoginPage(){
        require __DIR__ . "/../views/adminlogin.php";
    }

    public function adminRegisterPage(){
        require __DIR__ . "/../views/adminregister.php";
    }

    public function adminLogin() {
        header('Content-Type: application/json');
        $email = trim($_POST['admin_email'] ?? '');
        $password = $_POST['admin_password'] ?? '';

        $admin = $this->model->login($email, $password);
        if ($admin) {
            // session_start();
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        }
    }
}
?>

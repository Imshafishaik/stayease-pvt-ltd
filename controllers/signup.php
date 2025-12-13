<?php
require __DIR__ . "/../models/signup.php";

class SignupController {
    private SignupModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new SignupModel($pdo);
    }

    public function signup()
{
    ob_clean();
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(["status" => "error", "message" => "Invalid request"]);
        exit;
    }

    try {
        $name     = $_POST['name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $userType = $_POST['select_user_type'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            echo json_encode(["status" => "error", "message" => "Missing fields"]);
            exit;
        }

        if ($this->model->emailExists($email)) {
            echo json_encode(["status" => "error", "message" => "Email exists"]);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $passport = $_FILES['passport']['name'] ?? null;
        $visa     = $_FILES['visa']['name'] ?? null;

        $this->model->insertUser(
            $name,
            $email,
            $hashedPassword,
            $userType,
            $passport,
            $visa
        );

        echo json_encode(["status" => "success"]);
        exit;

    } catch (Throwable $e) {
        error_log($e->getMessage());
        echo json_encode([
            "status" => "error",
            "message" => "Server error"
        ]);
        exit;
    }
}

    // public function signup() {
    //     ob_clean();
    //     header('Content-Type: application/json; charset=utf-8');

    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //         http_response_code(405);
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "Method not allowed"
    //         ]);
    //         exit;
    //     }

    //     $name     = $_POST['name'] ?? '';
    //     $email    = $_POST['email'] ?? '';
    //     $password = $_POST['password'] ?? '';
    //     $userType = $_POST['select_user_type'] ?? '';

    //     if ($name === '' || $email === '' || $password === '') {
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "All fields are required"
    //         ]);
    //         exit;
    //     }

    //     // Hash password
    //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //     // File uploads
    //     $passportPath = null;
    //     $visaPath = null;

    //     if (!empty($_FILES['passport']['name'])) {
    //         $passportPath = time() . "_passport_" . $_FILES['passport']['name'];
    //         move_uploaded_file(
    //             $_FILES['passport']['tmp_name'],
    //             __DIR__ . "/../uploads/" . $passportPath
    //         );
    //     }

    //     if (!empty($_FILES['visa']['name'])) {
    //         $visaPath = time() . "_visa_" . $_FILES['visa']['name'];
    //         move_uploaded_file(
    //             $_FILES['visa']['tmp_name'],
    //             __DIR__ . "/../uploads/" . $visaPath
    //         );
    //     }

    //     // 🔍 Check email
    //     if ($this->model->emailExists($email)) {
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "Email already exists"
    //         ]);
    //         exit;
    //     }

    //     // ✅ Insert user
    //     $this->model->insertUser(
    //         $name,
    //         $email,
    //         $hashedPassword,
    //         $userType,
    //         $passportPath,
    //         $visaPath
    //     );

    //     echo json_encode([
    //         "status" => "success",
    //         "message" => "User registered successfully"
    //     ]);
    //     exit;
    // }
}

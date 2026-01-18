<?php
require __DIR__ . "/../models/adminprofile.php";
require __DIR__ . "/../helpers/useremail.php";
require_once __DIR__ . "/../models/login.php";

class AdminprofileController{
    private $model;
    private LoginModel $loginModel;

    public function __construct($pdo){
        $this->model = new AdminprofileModel($pdo);
        $this->loginModel = new LoginModel($pdo);
    }

    public function adminprofile(){
        $students_admin = $this->model->studentVerify();
        $owner_admin = $this->model->ownerVerify();
        require __DIR__ . "/../views/adminprofile.php";
    }

//     public function approveDocument(){
//     while (ob_get_level()) {
//         ob_end_clean();
//     }

//     header('Content-Type: application/json; charset=utf-8');
//     ini_set('display_errors', 0);
//     error_reporting(E_ALL);

//     try {
//         $userId = (int)($_POST['user_id'] ?? 0);
//         $action = $_POST['action'] ?? '';

//         if (!$userId || !$action) {
//             throw new Exception('Invalid input');
//         }

//         if ($action === 'accept') {
//             $this->model->approveUserDocument($userId);
//         } elseif ($action === 'reject') {
//             $this->model->rejectUserDocument($userId);
//         } else {
//             throw new Exception('Invalid action');
//         }
//         $user = $this->loginModel->getUserById($userId);
//         print_r($user);
//         if($user['user_check']){
//         sendUserMail(
//             $toEmail = $user['user_email'],
//             $toName = $user['user_name'],
//             $subject = 'User Registration Successfully'
//         );
//         }
//         echo json_encode([
//             'status' => 'success'
//         ]);
//         exit;

//     } catch (Throwable $e) {
//         error_log($e->getMessage());
//         echo json_encode([
//             'status' => 'error',
//             'message' => $e->getMessage()
//         ]);
//         exit;
//     }
// }

public function approveDocument()
{
    while (ob_get_level()) {
        ob_end_clean();
    }

    header('Content-Type: application/json; charset=utf-8');
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    try {
        $userId = (int)($_POST['user_id'] ?? 0);
        $action = $_POST['action'] ?? '';

        if (!$userId || !in_array($action, ['accept', 'reject'])) {
            throw new Exception('Invalid input');
        }

        if ($action === 'accept') {
            $this->model->approveUserDocument($userId);
        } else {
            $this->model->rejectUserDocument($userId);
        }

        // 🔁 Fetch updated user AFTER update
        $user = $this->loginModel->getUserById($userId);

        // ✅ Send mail ONLY when approved
        if ($action === 'accept' &&
    !empty($user) &&
    !empty($user['user_check']) &&
    !empty($user['user_email']) &&
    is_string($user['user_email'])) {
            sendUserMail(
                $user['user_email'],
                $user['user_name'],
                'User Registration Successfully'
            );
        }

        echo json_encode([
            'status' => 'success'
        ]);
        exit;

    } catch (Throwable $e) {
        error_log($e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}




}

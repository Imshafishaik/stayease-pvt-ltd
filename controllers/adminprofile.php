<?php
require __DIR__ . "/../models/adminprofile.php";

class AdminprofileController{
    private $model;

    public function __construct($pdo){
        $this->model = new AdminprofileModel($pdo);
    }

    public function adminprofile(){
        $students_admin = $this->model->studentVerify();
        $owner_admin = $this->model->ownerVerify();
        require __DIR__ . "/../views/adminprofile.php";
    }

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

        if (!$userId || !$action) {
            throw new Exception('Invalid input');
        }

        if ($action === 'accept') {
            $this->model->approveUserDocument($userId);
        } elseif ($action === 'reject') {
            $this->model->rejectUserDocument($userId);
        } else {
            throw new Exception('Invalid action');
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

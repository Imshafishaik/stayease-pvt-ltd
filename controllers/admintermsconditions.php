<?php
require __DIR__ . "/../models/admintermsconditions.php";

class AdmintermsconditionsController{

    private $model;

    public function __construct($pdo) {
        $this->model = new AdmintermsconditionsModel($pdo);
    }

    public function admintermsconditions(){
        $terms = $this->model->getTerms();
        require __DIR__ . "/../views/admintermsconditions.php";
    }

    public function terms(){
        $terms = $this->model->getTerms();
        require __DIR__ . "/../views/terms.php";
    }

    // User view
    public function show() {
        $terms = $this->model->getTerms();
        require __DIR__ . '/../views/terms.php';
    }

    // Admin edit page
    // public function edit_terms_conditions() {

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $this->model->updateTerms($_POST['content']);
    //     header("Location: /index.php?action=adm_terms_conditions&success=1");
    //     exit;
    // }
    // $terms = $this->model->getTerms();
    // require 'views/admin/edit_terms.php';
    // }

    public function edit_terms_conditions() {

    header('Content-Type: application/json; charset=utf-8');

    try {
        $content = trim($_POST['content'] ?? '');

        if ($content === '') {
            throw new Exception("Terms content cannot be empty");
        }

        $this->model->updateTerms($content);

        echo json_encode(["status" => "success"]);
        exit;

    } catch (Throwable $e) {
        error_log($e->getMessage());
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit;
    }
}
}

<?php
require __DIR__ . "/../models/owner.php";

class OwnersController {
    private OwnersModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new OwnersModel($pdo);
    }

    public function owner() {
        session_start();
 
        if (
            !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner'
        ) {
            header("Location: /index.php?action=login");
            exit;
        }

        $owner_info = $this->model->getOwnerInfo($_SESSION['user_id']);

        // ✅ FETCH DATA ONCE
        $accommodations = $this->model->getByOwner($_SESSION['user_id']);

        // ✅ PASS DATA TO VIEW
        require __DIR__ . "/../views/ownerlisting.php";
    }
}

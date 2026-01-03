<?php
require __DIR__ . "/../models/owner.php";

class OwnersController {
    private OwnersModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new OwnersModel($pdo);
    }

    public function owner() {

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner') {
        header("Location: /index.php?action=login");
        exit;
    }

    $userId = $_SESSION['user_id'];
    $owner_info = $this->model->getOwnerInfo($_SESSION['user_id']);
    // ✅ Pagination inputs
    $page  = max(1, (int)($_GET['page'] ?? 1));
    $limit = 6; // listings per page
    $offset = ($page - 1) * $limit;

    // ✅ Fetch paginated data
    $accommodations = $this->model->getByOwnerPaginated(
        $userId,
        $limit,
        $offset
    );

    // ✅ Count total listings
    $totalRecords = $this->model->countByOwner($userId);
    $totalPages   = (int) ceil($totalRecords / $limit);

    require __DIR__ . "/../views/ownerlisting.php";
}

    
}

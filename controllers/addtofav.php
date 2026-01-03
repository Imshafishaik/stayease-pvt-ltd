<?php

require __DIR__ . "/../models/addtofav.php";

class FavouriteController {

    private FavouriteModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new FavouriteModel($pdo);
    }

    public function addFavourites() {

        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        // session_start();

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'login']);
            exit;
        }

        $accommodationId = (int)($_POST['accommodation_id'] ?? 0);

        if ($accommodationId <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid accommodation']);
            exit;
        }

        try {
            $added = $this->model->addToFavourites(
                $_SESSION['user_id'],
                $accommodationId
            );

            if ($added) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Already in favourites']);
            }

        } catch (Throwable $e) {
            error_log($e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Server error']);
        }
        exit;
    }

    public function allFavourites() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?action=login");
            exit;
        }

        $page  = max(1, (int)($_GET['page'] ?? 1));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $accommodations = $this->model->getUserFavourites(
            $_SESSION['user_id'],
            $limit,
            $offset
        );

        $total      = $this->model->countUserFavourites($_SESSION['user_id']);
        $totalPages = ceil($total / $limit);

        require __DIR__ . "/../views/addtofav.php";
    }
}

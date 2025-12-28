<?php
require __DIR__ . "/../models/review.php";

class ReviewController {
    private ReviewModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new ReviewModel($pdo);
    }

    public function submitReview() {
        session_start();
        header('Content-Type: application/json');

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Login required']);
            exit;
        }

        $this->model->addReview(
            $_POST['accommodation_id'],
            $_SESSION['user_id'],
            $_POST['rating'],
            $_POST['review']
        );
require __DIR__ . '/../views/review.php';
        // echo json_encode(['status' => 'success']);
        
    }

    public function review(){
        require __DIR__ . '/../views/review.php';
    }

    public function reviewPage($accommodationId) {
        $reviews = $this->model->getByAccommodation($accommodationId);
        $avgRating = $this->model->getAverageRating($accommodationId);
        require __DIR__ . '/../views/reviews.php';
    }
}

?>
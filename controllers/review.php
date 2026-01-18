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

    try {
        // User must be logged in
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Login required'
            ]);
            exit;
        }

        // Validate POST data
        $accommodationId = $_POST['accommodation_id'] ?? '';
        $rating = $_POST['rating'] ?? '';
        $review = trim($_POST['review'] ?? '');

        if ($accommodationId === '' || $rating === '' || $review === '') {
            throw new Exception("All fields are required");
        }

        if (!in_array($rating, ['1','2','3','4','5'])) {
            throw new Exception("Invalid rating");
        }

        // Save or update review
        $this->model->addReview(
            $accommodationId,
            $_SESSION['user_id'],
            $rating,
            $review
        );

        // Return JSON response (AJAX)
        echo json_encode([
            'status' => 'success',
            'message' => 'Review submitted successfully'
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
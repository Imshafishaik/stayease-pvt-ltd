<?php
require __DIR__ . "/../models/detail.php";

class AccomodationDetailController{
    private $model;

    public function __construct($pdo){
        $this->model = new DetailModel($pdo);
    }

    public function detail() {
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) {
            header("Location: /index.php?action=listing");
            exit;
        }

        $accommodation = $this->model->getAccommodation($id);
        $images        = $this->model->getImages($id);
        $reviews       = $this->model->getReviews($id);

        require __DIR__ . "/../views/detail.php";
    }
}

?>
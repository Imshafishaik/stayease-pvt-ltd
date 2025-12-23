<?php
require __DIR__ . "/../models/listing.php";

// class ListingController{
//     private $model;

//     public function __construct($pdo){
//         $this->model = new ListingModel($pdo);
//     }

//     public function listing(){
//         $accommodations = $this->model->getAll();
//         require __DIR__ . "/../views/listing.php";
//     }
// }

class ListingController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ListingModel($pdo);
    }

    public function listing() {
        $search = $_GET['search'] ?? '';
        $city   = $_GET['city'] ?? '';
        $price  = $_GET['price'] ?? '';

        $page  = max(1, (int)($_GET['page'] ?? 1));
        $limit = 6; // listings per page
        $offset = ($page - 1) * $limit; 

        $accommodations = $this->model->getFiltered($search, $city, $price,$limit,
            $offset);

            $total = $this->model->countFiltered($search, $city, $price);
        $totalPages = ceil($total / $limit);

        require __DIR__ . "/../views/listing.php";
    }
}



?>
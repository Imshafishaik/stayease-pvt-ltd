<?php
require __DIR__ . "/../models/rentupload.php";

class RentController {
    private RentuploadModel $model;

    public function __construct(PDO $pdo) {
        $this->model = new RentuploadModel($pdo);

        $this->s3 = new S3Client([
            'version'     => 'latest',
            'region'      => $_ENV['AWS_REGION'], // Replace with your bucket's region
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS_KEY'],      // Replace with your key
                'secret' => $_ENV['AWS_SECRET_KEY'],  // Replace with your secret
            ],
        ]);

        $this->bucket = 'stayease-pvt-ltd'; // Your bucket name
    }

    public function rentuploadpage(){
        require __DIR__ . "/../views/rentupload.php";
    }

    public function rentupload() {
    if (ob_get_length()) ob_clean();
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(["status"=>"error","message"=>"Invalid request"]);
        exit;
    }

    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status"=>"error","message"=>"Unauthorized"]);
        exit;
    }

    try {
        $name        = $_POST['property_name'] ?? '';
        $address     = $_POST['property_address'] ?? '';
        $price       = $_POST['rent_cost'] ?? 0;
        $description = $_POST['property_description'] ?? '';
        $furnished   = isset($_POST['is_furnished']) ? 1 : 0;
        $available   = isset($_POST['availability_status']) ? 1 : 0;

        if ($name === '' || $address === '' || $price <= 0) {
            echo json_encode(["status"=>"error","message"=>"Missing fields"]);
            exit;
        }

        $accommodationId = $this->model->insertAccommodation(
            $name,
            $description,
            $address,
            $price,
            $furnished,
            $available,
            $_SESSION['user_id']
        );

        if (!empty($_FILES['property_pictures']['name'])) {
            $imageName = time() . "_" . $_FILES['property_pictures']['name'];
            // move_uploaded_file(
            //     $_FILES['property_pictures']['tmp_name'],
            //     __DIR__ . "/../uploads/" . $imageName
            // );

            $this->model->insertDocument(
                $imageName,
                $_SESSION['user_id'],
                $accommodationId
            );
        }

        echo json_encode(["status"=>"success"]);
        exit;

    } catch (Throwable $e) {
        error_log($e->getMessage());
        echo json_encode(["status"=>"error","message"=>"Server error"]);
        exit;
    }
}
}

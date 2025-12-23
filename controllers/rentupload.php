<?php
require __DIR__ . "/../models/rentupload.php";
require __DIR__ . "/../vendor/autoload.php";

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class RentController {
    private RentuploadModel $model;
    private S3Client $s3;
    private string $bucket;

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


        $this->bucket =  $_ENV['AWS_S3_BUCKET']; // Your bucket name
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

            // --- Multiple Images Upload ---
            if (!empty($_FILES['property_pictures']['name'][0])) {
                $files = $_FILES['property_pictures'];

                $fileCount = count($files['name']);
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;

                    $tmpFile = [
                        'name' => $files['name'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'type' => $files['type'][$i],
                        'size' => $files['size'][$i],
                    ];

                    // Upload to S3
                    $s3Key = "owners/house_images/" . time() . "_" . basename($tmpFile['name']);
                    $result = $this->s3->putObject([
                        'Bucket'      => $this->bucket,
                        'Key'         => $s3Key,
                        'SourceFile'  => $tmpFile['tmp_name'],
                        'ContentType' => mime_content_type($tmpFile['tmp_name']),
                        // ACL removed because your bucket has ACLs disabled
                    ]);

                    $imageUrl = $result['ObjectURL'];

                    // Save S3 URL in database
                    $this->model->insertDocument($imageUrl, $_SESSION['user_id'], $accommodationId);
                }
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
?>

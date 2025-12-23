<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../models/rentupload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class RentController {
    private RentuploadModel $model;
    private S3Client $s3;
    private string $bucket;

    public function __construct(PDO $pdo) {
        $this->model = new RentuploadModel($pdo);

        $this->s3 = new S3Client([
            'version'     => 'latest',
            'region'      => $_ENV['AWS_REGION'],
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS_KEY'],
                'secret' => $_ENV['AWS_SECRET_KEY'],
            ],
        ]);

        $this->bucket = $_ENV['AWS_BUCKET'];
    }

    public function rentuploadpage(){
        require __DIR__ . "/../views/rentupload.php";
    }

    public function rentupload() {
        ob_clean();
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

            if (!empty($_FILES['property_pictures']['name'][0])) {
                foreach ($_FILES['property_pictures']['name'] as $index => $fileName) {
                    $tmpName = $_FILES['property_pictures']['tmp_name'][$index];
                    $s3FileName = time() . "_" . basename($fileName);

                    $this->s3->putObject([
                        'Bucket' => $this->bucket,
                        'Key'    => $s3FileName,
                        'SourceFile' => $tmpName,
                        'ACL'    => 'private',
                    ]);

                    $this->model->insertDocument($s3FileName, $_SESSION['user_id'], $accommodationId);
                }
            }

            echo json_encode(["status"=>"success"]);
            exit;

        } catch (AwsException $e) {
            error_log($e->getMessage());
            echo json_encode(["status"=>"error","message"=>"AWS S3 error"]);
            exit;
        } catch (Throwable $e) {
            error_log($e->getMessage());
            echo json_encode(["status"=>"error","message"=>"Server error"]);
            exit;
        }
    }
}

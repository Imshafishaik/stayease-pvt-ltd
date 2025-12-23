<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../models/signup.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class SignupController {
    private SignupModel $model;
    private S3Client $s3;
    private string $bucket;

    public function __construct(PDO $pdo) {
        $this->model = new SignupModel($pdo);

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

    public function signup() {
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Invalid request"]);
            exit;
        }

        try {
            $name     = $_POST['name'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $userType = $_POST['select_user_type'] ?? '';

            if (!$name || !$email || !$password) {
                echo json_encode(["status" => "error", "message" => "Missing fields"]);
                exit;
            }

            if ($this->model->emailExists($email)) {
                echo json_encode(["status" => "error", "message" => "Email already exists"]);
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Handle files (passport, visa)
            $uploadedFiles = [];
            foreach (['passport', 'visa'] as $fileKey) {
                if (!empty($_FILES[$fileKey]['name'])) {
                    $fileName = time() . "_" . basename($_FILES[$fileKey]['name']);
                    $fileTmp  = $_FILES[$fileKey]['tmp_name'];

                    $this->s3->putObject([
                        'Bucket' => $this->bucket,
                        'Key'    => $fileName,
                        'SourceFile' => $fileTmp,
                        'ACL'    => 'private', // or 'public-read' if you want public
                    ]);

                    $uploadedFiles[$fileKey] = $fileName;
                }
            }

            $this->model->insertUser(
                $name,
                $email,
                $hashedPassword,
                $userType,
                $uploadedFiles['passport'] ?? null,
                $uploadedFiles['visa'] ?? null
            );

            echo json_encode(["status" => "success"]);
            exit;

        } catch (AwsException $e) {
            error_log($e->getMessage());
            echo json_encode(["status" => "error", "message" => "AWS S3 error"]);
            exit;
        } catch (Throwable $e) {
            error_log($e->getMessage());
            echo json_encode(["status" => "error", "message" => "Server error"]);
            exit;
        }
    }
}

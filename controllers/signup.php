<?php
require __DIR__ . "/../models/signup.php";
require __DIR__ . "/../vendor/autoload.php";

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class SignupController {
    private SignupModel $model;
    private S3Client $s3;
    private string $bucket;

    public function __construct(PDO $pdo) {
        $this->model = new SignupModel($pdo);

        // --- AWS S3 Configuration ---
        $this->s3 = new S3Client([
            'version'     => 'latest',
            'region'      => $_ENV['AWS_REGION'], // Replace with your bucket's region
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS_KEY'],      // Replace with your key
                'secret' => $_ENV['AWS_SECRET_KEY'],  // Replace with your secret
            ],
        ]);

        $this->bucket = $_ENV['AWS_S3_BUCKET']; // Replace with your bucket name
    }

    public function signuppage() {
        require __DIR__ . "/../views/signup.php";
    }

    public function signup() {
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Invalid request"]);
            exit;
        }

        try {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $userType = $_POST['select_user_type'] ?? '';

            if ($name === '' || $email === '' || $password === '' || $userType === '') {
                throw new Exception("All fields are required");
            }

            if ($this->model->emailExists($email)) {
                throw new Exception("Email already exists");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // --- FILE UPLOAD ---
            $docOne = null;
            $docTwo = null;

            if ($userType === 'student') {
                if (!isset($_FILES['passport'], $_FILES['visa'])) {
                    throw new Exception("Passport and Visa are required");
                }
                $docOne = $this->uploadFile($_FILES['passport'], "students/passports");
                $docTwo = $this->uploadFile($_FILES['visa'], "students/visas");

            } elseif ($userType === 'owner') {
                if (!isset($_FILES['house-document'], $_FILES['house-registration'])) {
                    throw new Exception("House documents are required");
                }
                $docOne = $this->uploadFile($_FILES['house-document'], "owners/house_documents");
                $docTwo = $this->uploadFile($_FILES['house-registration'], "owners/house_registrations");
            }
            
            // Insert user into DB
            $this->model->insertUser($name, $email, $hashedPassword, $userType, $docOne, $docTwo);

            echo json_encode(["status" => "success"]);
            exit;

        } catch (Throwable $e) {
            error_log($e->getMessage());
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        }
    }

    private function uploadFile(array $file, string $folder): string {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload failed: " . $file['name']);
        }

        $key = $folder . '/' . time() . '_' . basename($file['name']);

        try {
            $result = $this->s3->putObject([
                'Bucket'      => $this->bucket,
                'Key'         => $key,
                'SourceFile'  => $file['tmp_name'],
                // 'ACL'         => 'public-read', // Makes the file publicly accessible
                'ContentType' => mime_content_type($file['tmp_name']),
            ]);

            return $result['ObjectURL'];
        } catch (AwsException $e) {
            throw new Exception("S3 Upload Failed: " . $e->getMessage());
        }
    }
}
?>

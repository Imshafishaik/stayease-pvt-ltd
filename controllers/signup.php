<?php
require __DIR__ . "/../models/signup.php";
require __DIR__ . "/../helpers/filesize.php";
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

    private function uploadErrorMessage(int $errorCode): string
{
    return match ($errorCode) {
        UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE  => 'File exceeds form MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION  => 'File upload blocked by PHP extension',
        default               => 'Unknown upload error',
    };
}

    private function validateUpload(array $file): void
{

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception($this->uploadErrorMessage($file['error']));
    }


    $uploadMax = phpSizeToBytes(ini_get('upload_max_filesize'));
    $postMax   = phpSizeToBytes(ini_get('post_max_size'));
    $memoryMax = phpSizeToBytes(ini_get('memory_limit'));

    if ($file['size'] > $uploadMax) {
        throw new Exception("File exceeds upload_max_filesize (" . ini_get('upload_max_filesize') . ")");
    }

    if ($file['size'] > $postMax) {
        throw new Exception("File exceeds post_max_size (" . ini_get('post_max_size') . ")");
    }

    if ($file['size'] > ($memoryMax / 2)) {
        throw new Exception("File too large for available memory");
    }

    if ((int)ini_get('max_execution_time') < 300) {
        throw new Exception("Server execution time too low for upload");
    }
}


    private function uploadFile(array $file, string $folder): string {
            // if ($file['error'] !== UPLOAD_ERR_OK) {
            //     throw new Exception("File upload failed: " . $file['name'],$folder);
            // }

        $this->validateUpload($file);   

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

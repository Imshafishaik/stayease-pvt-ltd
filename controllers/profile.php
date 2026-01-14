<?php
require __DIR__ . '/../models/profile.php';
require_once __DIR__ . '/../helpers/filesize.php';
require __DIR__ . '/../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class ProfileController {

    private ProfileModel $model;
    private S3Client $s3;
    private string $bucket;

    public function __construct(PDO $pdo) {

        $this->model = new ProfileModel($pdo);

        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => $_ENV['AWS_REGION'],
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY'],
                'secret' => $_ENV['AWS_SECRET_KEY']
            ]
        ]);

        $this->bucket = $_ENV['AWS_S3_BUCKET'];
    }

    public function myProfile() {
        $user = $this->model->getUser($_SESSION['user_id']);
        require __DIR__ . '/../views/profile.php';
    }

    public function editProfilePage() {
        $edituser = $this->model->getUser($_SESSION['user_id']);
        require __DIR__ . '/../views/editprofile.php';
    }

    public function updateProfile() {
        ob_clean();
        header('Content-Type: application/json');

        try {
            $user = $this->model->getUser($_SESSION['user_id']);

            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                throw new Exception("Name is required");
            }

            $password = !empty($_POST['password'])
                ? password_hash($_POST['password'], PASSWORD_DEFAULT)
                : null;

            $docOne = null;
            $docTwo = null;

            if (!empty($_FILES['doc_one']['name'])) {
                $docOne = $this->uploadFile($_FILES['doc_one'], "{$user['user_type']}/documents");
            }

            if (!empty($_FILES['doc_two']['name'])) {
                $docTwo = $this->uploadFile($_FILES['doc_two'], "{$user['user_type']}/documents");
            }

            $this->model->updateUser(
                $user['user_id'],
                $name,
                $password,
                $docOne,
                $docTwo
            );

            echo json_encode(['status' => 'success']);
            exit;

        } catch (Throwable $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    private function uploadFile(array $file, string $folder): string {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Upload error");
        }

        $key = $folder . '/' . time() . '_' . basename($file['name']);

        try {
            $result = $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key' => $key,
                'SourceFile' => $file['tmp_name'],
                'ContentType' => mime_content_type($file['tmp_name'])
            ]);

            return $result['ObjectURL'];
        } catch (AwsException $e) {
            throw new Exception("S3 upload failed");
        }
    }
}

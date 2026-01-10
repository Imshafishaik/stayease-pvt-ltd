<?php
require __DIR__ . "/../models/orders.php";
require __DIR__ . "/../models/user.php";
require __DIR__ . "/../helpers/email.php";

class OrderController {
    private OrderModel $model;
    private UserModel $userModel;

    public function __construct(PDO $pdo) {
        $this->model = new OrderModel($pdo);
        $this->userModel  = new UserModel($pdo);
    }

    // Place order
   public function placeOrder() {
    // session_start();
    header('Content-Type: application/json');

    // 1. Check login
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'login']);
        exit;
    }

    $userId = (int) $_SESSION['user_id'];
    $accommodationId = (int) $_POST['accommodation_id'];

    // 2. Check documents
     $user = $this->userModel->getById($userId);
    if (empty($user['user_doc_one']) || empty($user['user_doc_two'])) {
        echo json_encode(['status' => 'docs']);
        exit;
    }

    // 3. Create booking request
    $this->model->createOrder($userId, $accommodationId);

    echo json_encode(['status' => 'success']);
}




    // Orders page
    public function ordersPage() {
        // session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /index.php?action=login');
            exit;
        }

        if ($_SESSION['user_type'] === 'owner') {
            $orders = $this->model->getByOwner($_SESSION['user_id']);
        } else {
            $orders = $this->model->getByUser($_SESSION['user_id']);
        }

        require __DIR__ . '/../views/orders.php';
    }

    public function getOwnerDashboard(){
    //  session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /index.php?action=login');
            exit;
        }

        if ($_SESSION['user_type'] === 'owner') {
            $orders = $this->model->getOwnerRequests($_SESSION['user_id']);
        } else {
            $orders = $this->model->getByUser($_SESSION['user_id']);
        }

        require __DIR__ . '/../views/ownerdashboard.php';
    }

    

public function updateBooking() {
    // session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner') {
        echo json_encode([
            'status' => 'error',
            'redirect' => '/index.php?action=login'
        ]);
        exit;
    }

    $orderId = (int) ($_POST['order_id'] ?? 0);
    $status  = $_POST['status'] ?? '';

    if (!$orderId || !in_array($status, ['accepted', 'rejected'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        exit;
    }

    $this->model->updateStatus($orderId, $status);

    $emails = $this->model->getOrderWithEmails($orderId);
    $userName = $_SESSION['user_name'];

    if ($status === 'accepted') {
        sendBookingMail(
            $emails['student_email'],
            $userName,
            "Your booking has been accepted",
                        $htmlBody = '
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Booking Update</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f4f6f8;
      font-family: Arial, Helvetica, sans-serif;
    }
    .email-wrapper {
      width: 100%;
      padding: 20px;
    }
    .email-container {
      max-width: 600px;
      background: #ffffff;
      margin: auto;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .header {
      background: #2b7cff;
      padding: 20px;
      text-align: center;
      color: #ffffff;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    .content {
      padding: 25px;
      color: #333333;
      line-height: 1.6;
    }
    .content h2 {
      margin-top: 0;
      color: #2b7cff;
    }
    .info-box {
      background: #f8f9fb;
      border-left: 4px solid #2b7cff;
      padding: 15px;
      margin: 20px 0;
      border-radius: 4px;
    }
    .info-box p {
      margin: 6px 0;
    }
    .cta {
      text-align: center;
      margin: 30px 0;
    }
    .cta a {
      background: #2b7cff;
      color: #ffffff;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 6px;
      font-weight: bold;
      display: inline-block;
    }
    .footer {
      background: #f4f6f8;
      text-align: center;
      padding: 15px;
      font-size: 12px;
      color: #777777;
    }
    @media(max-width: 600px) {
      .content {
        padding: 18px;
      }
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <div class="email-container">

      <div class="header">
        <h1>StayEase</h1>
      </div>

      <div class="content">
        <h2>Booking Update</h2>

        <p>Hello <strong>' . htmlspecialchars($userName) . '</strong>,</p>

        <p>
          We have an update regarding your accommodation booking on <strong>StayEase</strong>.
        </p>

        <div class="info-box">
          <p><strong>Accommodation:</strong> Sunny Villa</p>
          <p><strong>Location:</strong> Barcelona, Spain</p>
          <p><strong>Status:</strong> <span style="color:#2b7cff;font-weight:bold;">Booking Request Approved</span></p>
        </div>

        <p>
          🎉 <strong>Good news!</strong>  
          The owner has reviewed your booking request and approved it.
        </p>

        <p>
          You can now contact the accommodation owner directly to proceed with the next steps.
        </p>

        <div class="cta">
          <a href="https://stayease.com/login">Go to StayEase</a>
        </div>

        <p>
          If you have any questions, feel free to reach out to our support team.
        </p>

        <p>
          Best regards,<br>
          <strong>StayEase Team</strong>
        </p>
      </div>

      <div class="footer">
        © ' . date('Y') . ' StayEase. All rights reserved.
      </div>

    </div>
  </div>
</body>
</html>'
        );
    }

    echo json_encode([
        'status' => 'success',
        'redirect' => '/index.php?action=ownerdashboard'
    ]);
    exit;
}


}

?>

<?php
require __DIR__ . "/../models/orders.php";
require __DIR__ . "/../models/user.php";

class OrderController {
    private OrderModel $model;
    private UserModel $userModel;

    public function __construct(PDO $pdo) {
        $this->model = new OrderModel($pdo);
        $this->userModel  = new UserModel($pdo);
    }

    // Place order
   public function placeOrder() {
    session_start();
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
        session_start();

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
     session_start();

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

    public function updateOrderStatus() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'unauthorized']);
        exit;
    }

    $orderId = (int)$_POST['order_id'];
    $status  = $_POST['status'];

    if (!in_array($status, ['accepted', 'rejected'])) {
        echo json_encode(['status' => 'error']);
        exit;
    }

    $this->model->updateStatus($orderId, $status);

    echo json_encode(['status' => 'success']);
}

public function updateBooking() {
    session_start();

    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    $this->model->updateStatus($orderId, $status);

    if ($status === 'accepted') {
        $order = $this->model->getOrderWithEmails($orderId);

        mail(
            $order['user_email'],
            "Booking Accepted",
            "Your booking is accepted.\nYou can now contact the house owner at: ".$order['owner_email']
        );
    }

    // header('Location: /index.php?action=updatebooking');
}


}

?>

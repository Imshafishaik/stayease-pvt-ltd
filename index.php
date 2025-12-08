<?php
require "./config/database.php";
require "./controllers/home.php";
require "./controllers/login.php";
require "./controllers/signup.php";

$home_controller = new HomeController($pdo);
$login_controller = new LoginController($pdo);
$signup_controller = new SignupController($pdo);

$action = $_GET['action'] ?? 'index';
echo $action;
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create':    $controller->create(); break;
    case 'login':     $login_controller->login(); break;
    case 'signup':     $signup_controller->signup(); break;
    // case 'store':     $controller->store(); break;
    // case 'edit':      $controller->edit($id); break;
    // case 'update':    $controller->update($id); break;
    // case 'delete':    $controller->delete($id); break;
    default:          $home_controller->home();
}
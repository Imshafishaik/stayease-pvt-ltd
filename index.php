<?php
require "./config/database.php";
require "./controllers/home.php";
require "./controllers/login.php";
require "./controllers/signup.php";
require "./controllers/contact.php";
require "./controllers/owner.php";

$home_controller = new HomeController($pdo);
$login_controller = new LoginController($pdo);
$signup_controller = new SignupController($pdo);
$contact_controller = new ContactController($pdo);
$owners_controller = new OwnersController($pdo);


$action = $_GET['action'] ?? 'index';

$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create':    $controller->create(); break;
    case 'login':     $login_controller->login(); break;
    case 'signup':     $signup_controller->signup(); break;
    case 'contact':     $contact_controller->contact(); break;
    case 'owner':      $owners_controller->owner(); break;
    // case 'update':    $controller->update($id); break;
    // case 'delete':    $controller->delete($id); break;
    default:          $home_controller->home();
}
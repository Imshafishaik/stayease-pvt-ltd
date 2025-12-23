<?php
require "./config/database.php";
require "./controllers/home.php";
require "./controllers/login.php";
require "./controllers/signup.php";
require "./controllers/contact.php";
require "./controllers/owner.php";
require "./controllers/listing.php";
require "./controllers/admin.php";
require "./controllers/adminprofile.php";
require "./controllers/rentupload.php";

$home_controller = new HomeController($pdo);
$login_controller = new LoginController($pdo);
$signup_controller = new SignupController($pdo);
$contact_controller = new ContactController($pdo);
$owners_controller = new OwnersController($pdo);
$listing_controller = new ListingController($pdo);
$admin_controller = new AdminController($pdo);
$rentupload_controller = new RentController($pdo);
$admin_profile_controller = new AdminprofileController($pdo);

$action = $_GET['action'] ?? 'index';

$id = $_GET['id'] ?? null;


switch ($action) {
    case 'create':    $controller->create(); break;
    case 'login':     $login_controller->login(); break;
    case 'signup':     $signup_controller->signup(); break;
    case 'contact':     $contact_controller->contact(); break;
    case 'owner':      $owners_controller->owner(); break;
    case 'listing': $listing_controller->listing(); break;
    case 'forgot':    $controller->forgot(); break;
    // case 'delete':    $controller->delete($id); break;
    case 'rentupload':     $rentupload_controller->rentuploadpage(); break;
    case 'rentuploadpage':     $rentupload_controller->rentupload(); break;
    case 'adminprofile':     $adminprofile_controller->adminprofile(); break;
    case '7654': $admin_profile_controller->adminprofile(); break;
    default:          $home_controller->home();
}
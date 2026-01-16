<?php
ob_start();

session_start();

ini_set('display_errors', 0);
error_reporting(E_ALL);

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
require "./controllers/detail.php";
require "./controllers/faqs.php";
require "./controllers/adminfaq.php";
require "./controllers/review.php";
require "./controllers/orders.php";
require "./controllers/addtofav.php";
require "./controllers/forgot.php";
require "./controllers/resetpass.php";
require "./controllers/profile.php";
require "./controllers/admintermsconditions.php";

// Instantiate controllers
$home_controller = new HomeController($pdo);
$login_controller = new LoginController($pdo);
$signup_controller = new SignupController($pdo);
$contact_controller = new ContactController($pdo);
$owners_controller = new OwnersController($pdo);
$listing_controller = new ListingController($pdo);
$admin_controller = new AdminController($pdo);
$rentupload_controller = new RentController($pdo);
$admin_profile_controller = new AdminprofileController($pdo);
$accomodation_detail_controller = new AccomodationDetailController($pdo);
$faq_controller = new FAQController($pdo);
$faq_admin_controller = new AdminFaqController($pdo);
$review_controller= new ReviewController($pdo);
$orders_controller= new OrderController($pdo);
$add_to_fav_controller= new FavouriteController($pdo);
$forgot_controller= new ForgotController($pdo);
$reset_pass_controller= new PasswordResetController($pdo);
$profile_controller = new ProfileController($pdo);
$admintermsconditions_controller = new AdmintermsconditionsController($pdo);

// Get request parameters
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Route actions
switch ($action) {
    case 'create':    $controller->create(); break;
    case 'loginpage': $login_controller->loginpage(); break;
    case 'login':     $login_controller->login(); break;
    case 'logout': $login_controller->logout(); break;
    case 'signuppage':     $signup_controller->signuppage(); break;
    case 'signup':     $signup_controller->signup(); break;
    case 'terms':     $admintermsconditions_controller->terms(); break;
    case 'contact':     $contact_controller->contact(); break;
    case 'emailSend':     $contact_controller->emailSend(); break;
    case 'owner':      $owners_controller->owner(); break;
    case 'listing': $listing_controller->listing(); break;
    case 'accomodation_detail': $accomodation_detail_controller->detail(); break;
    case 'forgot':    $login_controller->forgot(); break;
    case 'forgotpass':    $login_controller->forgotpass(); break;
    case 'faqs':    $faq_controller->faq(); break;
    case 'getfaqs': $faq_controller->getFaqs(); break;
    case 'postfaq':    $faq_controller->postQuestion(); break;
    case 'postanswer':    $faq_controller->postAnswer(); break;
    case 'resetpage': $reset_pass_controller->resetPage(); break;
    case 'reset': $reset_pass_controller->reset(); break;
    case 'rentupload':     $rentupload_controller->rentuploadpage(); break;
    case 'rentuploadpage':     $rentupload_controller->rentupload(); break;
    case 'adminprofile':     $admin_profile_controller->adminprofile(); break;
    case '7654': $admin_controller->adminLoginPage(); break;
    case 'admin_register': $admin_controller->adminRegisterPage(); break;
    case 'admin_registering': $admin_controller->adminRegister(); break;
    case 'admin_logining': $admin_controller->adminLogin(); break;
    case 'adm_mng_faq': $faq_admin_controller->adminfaq(); break;
    case 'adm_terms_conditions': $admintermsconditions_controller->admintermsconditions(); break;
    case 'edit_terms_conditions': $admintermsconditions_controller->edit_terms_conditions(); break;
    case 'review': $review_controller->review(); break;
    case 'orders': $orders_controller->ordersPage(); break;
    case 'placeOrder': $orders_controller->placeOrder(); break;
    case 'ownerdashboard': $orders_controller->getOwnerDashboard(); break;
    case 'updateorderstatus' : $orders_controller->updateOrderStatus(); break;
    case 'updateBooking': $orders_controller->updateBooking(); break;
    case 'submitReview': $review_controller->submitReview(); break;
    case 'admin_answer_faq': $faq_admin_controller->answer(); break;
    case 'addFavourites': $add_to_fav_controller->addFavourites(); break;
    case 'allfavourites': $add_to_fav_controller->allFavourites(); break;
    case 'approveDocument': $admin_profile_controller->approveDocument(); break;
    case 'myprofile': $profile_controller->myProfile(); break;
    case 'editprofile': $profile_controller->editProfilePage(); break;
    case 'updateprofile':$profile_controller->updateProfile();break;
    default:          $home_controller->home();
}

// Flush output buffer
ob_end_flush();

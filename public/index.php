<?php


//** Config **//

// Enable all error levels
error_reporting(-1);
// Output all errors to the browser (should only be used in development)
ini_set('display_errors', 1);

// Define some global constants
define('CONTROLLER_DIR', realpath(__DIR__ . '/../controllers'));
define('VIEW_DIR', realpath(__DIR__ . '/../views'));


//** Init **//

// Handles the PHPSESSID cookie and populates the $_SESSION array with the users data
session_start();

$logincredentials = array(
  array("testuser", "12345"),
  array("testuser2", "123456")
);


//** Routing **//

// Convert i.e. "/foo%40bar?id=1" to "/foo@bar"
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


// If not logged in, then use the login controller.
if(!isset($_SESSION['isLoggedIn'])) {
  require CONTROLLER_DIR . '/login.php';
  exit;
}


// Otherwise run requested controller
switch ($uri) {
    case '/':
        require CONTROLLER_DIR . '/gallery.php';
        break;

    case '/users':
        require CONTROLLER_DIR . '/users.php';
        break;

    default:
        // There is a HTTP status code "404 File Not Found", but I don't want
        // to use that here because I actually output something
        require CONTROLLER_DIR . '/404.php';
        break;
}




?>

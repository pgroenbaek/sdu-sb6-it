<?php
use Kernel\Autoloader;
use Kernel\Container;
use Kernel\Router;

//********* Config *********//

// DB config.
$dbuser = 'peter';
$dbpass = '12345';

// Enable all error levels.
error_reporting(-1);
// Output all errors to the browser (should only be used in development).
ini_set('display_errors', 1);

// Define some global constants.
define('CONTROLLER_DIR', realpath(__DIR__ . '/../controllers'));
define('VIEW_DIR', realpath(__DIR__ . '/../views'));


//********* Init *********//

// Connect to DB.
$db = new PDO('mysql:host=localhost;dbname=website_gallery', $dbuser, $dbpass);

// Session init.
session_start();

// Require the autoloader.
require __DIR__ . '/../Kernel/Autoloader.php';

// Init and configure autoloader.
$loader = new \Kernel\Autoloader();
$loader->addNamespace('Kernel', __DIR__ . '/../Kernel');
$loader->addNamespace('Gallery', __DIR__ . '/../Gallery');
$loader->register();

// Init and configure DI container.
$container = new Container();
$container->bindArguments('Gallery\\Model\\UserDao', ['db' => $db]); // Not sure if this is the correct thing to do, but it works.
$container->bindArguments('Gallery\\Model\\ImageDao', ['db' => $db]); // Not sure if this is the correct thing to do, but it works.


//********* Routing *********//

// Init router and add routes.
$router = new Router();
$router->addRoute('GET', '/', ['Gallery\\Controller\\GalleryController', 'viewGallery']);
$router->addRoute('GET', '/upload', ['Gallery\\Controller\\GalleryController', 'viewUpload']);
$router->addRoute('POST', '/', ['Gallery\\Controller\\GalleryController', 'performUpload']);

$router->addRoute('GET', '/users', ['Gallery\\Controller\\UsersController', 'viewUsers']);
$router->addRoute('GET', '/users/add', ['Gallery\\Controller\\UsersController', 'viewAddUser']);
$router->addRoute('POST', '/users', ['Gallery\\Controller\\UsersController', 'performAddUser']);

$router->addRoute('POST', '/login', ['Gallery\\Controller\\LoginController', 'performLogin']);
$router->addRoute('GET', '/logout', ['Gallery\\Controller\\LoginController', 'performLogout']);



// Convert i.e. "/foo%40bar?id=1" to "/foo@bar"
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$route = $router->match($_SERVER['REQUEST_METHOD'], $uri);


// Always redirect to login-page when not logged in, unless user is attempting to log in.
if(!isset($_SESSION['isLoggedIn']) && $route['handle'][1] != 'performLogin') {
    $route = [
        'handle' => ['Gallery\\Controller\\LoginController', 'showLogin'],
        'arguments' => []
    ];
}
// Show 404 error if route did not exist.
else if($route === null) {
    $route = [
        'handle' => ['Gallery\\Controller\\ErrorController', 'error404'],
        'arguments' => []
    ];
}

// Otherwise call proper controller.
$controller = $container->create($route['handle'][0]);
$container->call([$controller, $route['handle'][1]], $route['arguments']);

?>

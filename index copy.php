<?php



// Meus includes


include './src/db.php';
$dbInstance = Conn::getInstance();

include './src/tools/filters.php';
$filters = new Filters();

include './src/errors.php';

include './src/controllers/main-controller.php';
$routes = new RoutesController($dbInstance, $filters, $err);

require_once  'vendor/autoload.php';
$klein = new \Klein\Klein();


if (preg_match('#^/assets/#', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

$klein->respond('GET', '/', [$routes, 'Index']);
$klein->respond('GET', '/login', [$routes, 'Login']);
$klein->respond('GET', '/register', [$routes, 'Register']);
$klein->respond('POST', '/register', [$routes, 'confirmRegister']);

$klein->dispatch();

?>
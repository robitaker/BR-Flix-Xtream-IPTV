<?php


use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;


if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

require "./vendor/autoload.php";
$app = AppFactory::create();

// Meus includes

include './src/db.php';
$dbInstance = Conn::getInstance();

include './src/tools/filters.php';
$filters = new Filters();


include './src/msg.php';
include './src/controllers/main-controller.php';

$routes = new RoutesController($dbInstance, $filters, $msg);


$app->get('/', [$routes, 'Index']);

$app->get('/register[/{redirect}]', [$routes, 'Register']);
$app->post('/register', [$routes, 'confirmRegister']);

$app->get('/login[/{redirect}]', [$routes, 'Login']);
$app->post('/login', [$routes, 'checkLogin']);

$app->get('/movie/{id}', [$routes, 'detailMovie']);
$app->get('/serie/{id}', [$routes, 'detailSerie']);

$app->get('/catalog[/{type}/{genre}/{page}]', [$routes, 'Catalog']);
$app->get('/search/{search:.+}', [$routes, 'Search']);

$app->get('/watch/{type}/{id}/{extension}', [$routes, 'watchMovie']);



$app->group('/profile', function (RouteCollectorProxy $group) use ($routes) {

    $group->post('/add-list', [$routes, 'addList']);
    $group->delete('/remove-list', [$routes, 'removeList']);

    $group->post('/add-watched', [$routes, 'addWatched']);
    $group->post('/checkpoint-watched', [$routes, 'updateCheckpoint']);


});






$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', [$routes, 'pageError']);





$app->run();

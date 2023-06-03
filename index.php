<?php
use Slim\Factory\AppFactory;

session_start();

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

$app->get('/register', [$routes, 'Register']);
$app->post('/register', [$routes, 'confirmRegister']);

$app->get('/login', [$routes, 'Login']);
$app->post('/login', [$routes, 'checkLogin']);

$app->get('/movie/{id}', [$routes, 'detailMovie']);
$app->get('/serie/{id}', [$routes, 'detailSerie']);


$app->get('/watch/{type}/{id}/{extension}', [$routes, 'watchMovie']);


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', [$routes, 'pageError']);





$app->run();

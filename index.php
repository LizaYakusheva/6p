<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\PhpRenderer;
use Src\Controllers\Admin\AdminCategoryController;
use Src\Controllers\Admin\AdminGoogController;
use Src\Controllers\Auth\LoginController;
use Src\Controllers\Auth\RegisterController;
use Src\Controllers\Auth\UserConroller;
use Src\Controllers\CategoryController;
use Src\Controllers\GoogController;
use Src\Controllers\OrderController;
use Src\Middleware\AdminMiddleware;
use Src\Middleware\AuthMiddleware;

require __DIR__ . '/vendor/autoload.php';

session_start();

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

$container->set(PhpRenderer::class, function () {
    return new PhpRenderer(
        __DIR__ . '/templates',
        [
        'categories' => ORM::forTable('categories')
            ->whereNull('parent_category')
            ->findMany(),
        ]

    );
});

ORM::configure('mysql:host=database;dbname=docker; charset=utf8mb4');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/login', [LoginController::class, 'loginPage']);
$app->post('/login', [LoginController::class, 'login']);
$app->get('/register', [RegisterController::class, 'registerPage']);
$app->post('/register', [RegisterController::class, 'register']);

$app->get('/', [CategoryController::class, 'index']);
$app->get('/good', [GoogController::class, 'index']);
$app->get('/good/{id}', [GoogController::class, 'show']);
$app->get('/good/{id}/order', [OrderController::class, 'store']);

$app->group('/', function () use ($app){
    $app->get('/user', [UserConroller::class, 'index']);
    $app->get('/logout', [LoginController::class, 'logout']);
})->add(new AuthMiddleware($container->get(ResponseFactory::class)));

$app->group('/', function () use($app){
    $app->get('/admin', [AdminCategoryController::class, 'index']);
    $app->get('/admin/category', [AdminCategoryController::class, 'indexCategory']);
    $app->post('/admin/category', [AdminCategoryController::class, 'store']);
    $app->get('/admin/category/{id}/edit', [AdminCategoryController::class, 'edit']);
    $app->post('/admin/category/{id}/edit', [AdminCategoryController::class, 'update']);
    $app->get('/admin/category/{id}/delete', [AdminCategoryController::class, 'delete']);

    $app->get('/admin/good', [AdminGoogController::class, 'indexGood']);
    $app->post('/admin/good', [AdminGoogController::class, 'store']);
    $app->get('/admin/good/{id}/edit', [AdminGoogController::class, 'edit']);
    $app->post('/admin/good/{id}/edit', [AdminGoogController::class, 'update']);
    $app->get('/admin/good/{id}/delete', [AdminGoogController::class, 'delete']);
})->add(new AdminMiddleware($container->get(ResponseFactory::class)));

$app->get('/{slug}', [CategoryController::class, 'index']);

$app->run();
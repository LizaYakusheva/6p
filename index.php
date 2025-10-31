<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Src\Controllers\Admin\AdminCategoryController;
use Src\Controllers\Admin\AdminGoogController;
use Src\Controllers\CategoryController;
use Src\Controllers\GoogController;

require __DIR__ . '/vendor/autoload.php';

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

$app->get('/', [CategoryController::class, 'index']);
$app->get('/admin', [AdminCategoryController::class, 'index']);
$app->get('/admin/category', [AdminCategoryController::class, 'indexCategory']);
$app->post('/admin/category', [AdminCategoryController::class, 'store']);
$app->get('/admin/good', [AdminGoogController::class, 'indexGood']);
$app->post('/admin/good', [AdminGoogController::class, 'store']);
$app->get('/admin/good/{id}/edit', [AdminGoogController::class, 'edit']);
$app->post('/admin/good/{id}/edit', [AdminGoogController::class, 'update']);
$app->get('/good', [GoogController::class, 'index']);
$app->get('/admin/category/{id}/edit', [AdminCategoryController::class, 'edit']);
$app->post('/admin/category/{id}/edit', [AdminCategoryController::class, 'update']);
$app->get('/admin/category/{id}/delete', [AdminCategoryController::class, 'delete']);
$app->get('/good/{id}', [GoogController::class, 'show']);

$app->get('/{slug}', [CategoryController::class, 'index']);

$app->run();
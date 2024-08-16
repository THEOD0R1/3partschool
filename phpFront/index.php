<?php
require_once(dirname(__FILE__) . "/src/utils/Router.php");
require_once("vendor/autoload.php");

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

$router->addRoute("/", function () {
    require __DIR__ . "/src/Pages/start.php";
});
$router->addRoute("/products", function () {
    require __DIR__ . "/src/Pages/products.php";
});
$router->addRoute("/products/manage", function () {
    require __DIR__ . "/src/Pages/manageProducts.php";
});
$router->addRoute("/products/manage/add", function () {
    require __DIR__ . "/src/Pages/addProduct.php";
});
$router->addRoute("/products/checkout", function () {
    require __DIR__ . "/src/Pages/checkout.php";
});
$router->addRoute("/products/manage/edit", function () {
    require __DIR__ . "/src/Pages/editProduct.php";
});

$router->dispatch();
?>
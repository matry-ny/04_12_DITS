<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new \components\App();
$products = new \app\api\controllers\ProductsController();
var_dump($app, $products);

<?php

namespace app\frontend\controllers;

use components\AbstractController;
use PDO;

/**
 * Class ProductsController
 * @package app\frontend\controllers
 */
class ProductsController extends AbstractController
{
  public function actionList()
  {
    $products = \components\App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare('SELECT * FROM products');

    var_dump($products->fetchAll(PDO::FETCH_ASSOC));
  }
}

<?php

namespace app\frontend\controllers;

use components\AbstractController;
use components\App;
use PDO;

/**
 * Class IndexController
 * @package app\frontend\controllers
 */
class IndexController extends AbstractController
{
  public function actionIndex()
  {
    $products = \components\App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare('SELECT * FROM products');
    $products->execute();

    App::get()->template()->render('index/index', [
      'products' => $products->fetchAll(PDO::FETCH_ASSOC)
    ]);
  }
}

<?php

namespace app\frontend\controllers;

use components\AbstractController;
use components\App;

/**
 * Class IndexController
 * @package app\frontend\controllers
 */
class IndexController extends AbstractController
{
  public function actionIndex()
  {
    $products = $this
      ->getQuery()
      ->select(['*'])
      ->from('products')
      ->fetchAll();

    App::get()->template()->render('index/index', [
      'products' => $products
    ]);
  }
}

<?php

namespace app\frontend\controllers;

use components\AbstractController;

/**
 * Class ProductsController
 * @package app\frontend\controllers
 */
class ProductsController extends AbstractController
{
  public function actionList()
  {
    echo 'frontend.products.list';
  }
}

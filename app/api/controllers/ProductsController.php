<?php

namespace app\api\controllers;

use components\AbstractController;

/**
 * Class ProductsController
 * @package app\api\controllers
 */
class ProductsController extends AbstractController
{
  public function actionList()
  {
    echo self::class;
  }
}
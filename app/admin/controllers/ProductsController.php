<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use components\App;

/**
 * Class ProductsController
 * @package app\admin\controllers
 */
class ProductsController extends AbstractAdminController
{
  public function actionList()
  {
    App::get()->template()->render('products/list');
  }
}

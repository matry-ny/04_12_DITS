<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use components\App;
use models\Products;

/**
 * Class ProductsController
 * @package app\admin\controllers
 */
class ProductsController extends AbstractAdminController
{
  public function actionList()
  {
    $products = (new Products())->find();
    $this->render('products/list', ['products' => $products]);
  }
}

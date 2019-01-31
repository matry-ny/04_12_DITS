<?php

namespace app\api\controllers;

use app\api\components\AbstractApiController;
use models\Products;

/**
 * Class ProductsController
 * @package app\api\controllers
 */
class ProductsController extends AbstractApiController
{
  public function actionGetList()
  {
    $productsModel = new Products();
    echo json_encode($productsModel->getPretty());
  }
}
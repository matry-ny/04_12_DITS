<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use helpers\RequestHelper;
use models\Authors;
use models\Products;

/**
 * Class ProductsController
 * @package app\admin\controllers
 */
class ProductsController extends AbstractAdminController
{
  public function actionList()
  {
    $products = $this->getModel()->find();
    $this->render('products/list', ['products' => $products]);
  }

  public function actionCreate()
  {
    if (RequestHelper::getIsPost()) {
      $this->getModel()->create($_POST);
      RequestHelper::redirect('/products/list');
    } else {
      $authors = (new Authors())->find();
      $this->render('products/create', ['authors' => $authors]);
    }
  }

  /**
   * @var null|Products
   */
  private $model = null;

  /**
   * @return Products
   */
  private function getModel(): Products
  {
    if (null === $this->model) {
      $this->model = new Products();
    }

    return $this->model;
  }
}

<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use components\App;
use helpers\ArrayHelper;
use helpers\RequestHelper;
use models\Authors;
use models\ProductImages;
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

      $productId = $this->getModel()->create($_POST);
      $files = ArrayHelper::reArrayFiles($_FILES['images']);
      (new ProductImages())->uploadImages($productId, $files);

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

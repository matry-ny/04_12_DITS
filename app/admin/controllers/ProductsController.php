<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use helpers\ArrayHelper;
use helpers\RequestHelper;
use models\Authors;
use models\entities\Product;
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
    $this->render('products/list', [
      'products' => Product::findAll()
    ]);
  }

  public function actionCreate()
  {
    if (RequestHelper::getIsPost()) {
      $model = new Product();
      $model->load($_POST);
      $model->save();

      $files = ArrayHelper::reArrayFiles($_FILES['images']);
      (new ProductImages())->uploadImages($model->id, $files);

      RequestHelper::redirect('/products/list');
    } else {
      $authors = (new Authors())->find();
      $this->render('products/create', ['authors' => $authors]);
    }
  }

  /**
   * @param int $id
   */
  public function actionUpdate(int $id)
  {
    $product = Product::findOne($id);

    if (RequestHelper::getIsPost()) {
      $product->load($_POST);
      $product->save();

      RequestHelper::redirect('/products/list');
    }

    $this->render('products/update', [
      'product' => $product,
      'authors' => (new Authors())->find()
    ]);
  }

  /**
   * @param int $id
   */
  public function actionDelete(int $id)
  {
    Product::findOne($id)->delete();

    RequestHelper::redirect('/products/list');
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

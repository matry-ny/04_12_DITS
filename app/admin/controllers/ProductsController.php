<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use components\App;
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
    $products = $this->getModel()->find();
    $this->render('products/list', ['products' => $products]);
  }

  public function actionCreate()
  {
    if (RequestHelper::getIsPost()) {
      $productId = $this
        ->getQuery()
        ->insert($_POST)
        ->into('products')
        ->execute();

      $files = ArrayHelper::reArrayFiles($_FILES['images']);
      (new ProductImages())->uploadImages($productId, $files);

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
      $this
        ->getQuery()
        ->update($_POST)
        ->into('products')
        ->where(["id = {$id}"])
        ->execute();

      RequestHelper::redirect('/products/list');
    }

//    $product = $this
//      ->getQuery()
//      ->select(['*'])
//      ->from('products')
//      ->where(["id = {$id}"])
//      ->fetchOne();

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
    $this
      ->getQuery()
      ->delete()
      ->from('products')
      ->where(["id = {$id} LIMIT 1"])
      ->execute();

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

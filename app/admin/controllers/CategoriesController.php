<?php

namespace app\admin\controllers;

use helpers\RequestHelper;
use models\Categories;
use app\admin\components\AbstractAdminController;

/**
 * Class CategoriesController
 * @package app\admin\controllers
 */
class CategoriesController extends AbstractAdminController
{
  public function actionList(): void
  {
    $categories = $this->getModel()->find();

    $this->render('categories/list', ['categories' => $categories]);
  }

  public function actionCreate()
  {
    if (RequestHelper::getIsPost()) {
      $this->getModel()->create($_POST);
      RequestHelper::redirect('/categories/list');
    } else {
      $this->render('categories/create');
    }
  }

  /**
   * @var null|Categories
   */
  private $model = null;

  /**
   * @return Categories
   */
  private function getModel(): Categories
  {
    if (null === $this->model) {
      $this->model = new Categories();
    }

    return $this->model;
  }
}

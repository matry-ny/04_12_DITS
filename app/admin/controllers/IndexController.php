<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use components\App;

/**
 * Class IndexController
 * @package app\admin\controllers
 */
class IndexController extends AbstractAdminController
{
  public function actionIndex()
  {
    App::get()->template()->render('index/index');
  }
}

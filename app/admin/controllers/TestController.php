<?php

namespace app\admin\controllers;

use app\admin\components\AbstractAdminController;
use traits\AmazonApiTrait;
use traits\GoogleApiTrait;
use traits\test\GoogleApiTrait as TestGoogleApiTrait;

/**
 * Class TestController
 * @package app\admin\controllers
 */
class TestController extends AbstractAdminController
{
  use GoogleApiTrait, AmazonApiTrait, TestGoogleApiTrait{
    GoogleApiTrait::getConnection insteadof AmazonApiTrait, TestGoogleApiTrait;
    GoogleApiTrait::getConnection as getGoogleConnection;
    AmazonApiTrait::getConnection as getAmazonConnection;
    TestGoogleApiTrait::getConnection as getTestGoogleConnection;
  }

  public function actionTraits()
  {
    var_dump(
      $this->getGoogleConnection(),
      $this->getAmazonConnection(),
      $this->getTestGoogleConnection()
    );
  }
}

<?php

namespace app\api\components;

use components\App;
use components\AbstractController;
use helpers\ArrayHelper;

/**
 * Class AbstractApiController
 * @package app\api\components
 */
class AbstractApiController extends AbstractController
{
  public function __construct()
  {
    $this->validateRequest();
    $this->setJsonAnswerFormat();
  }

  private function setJsonAnswerFormat()
  {
    header('Content-Type: application/json; charset=UTF-8');
  }

  private function validateRequest()
  {
    $allowedKeys = App::get()->config()['clients'];
    $actualKey = ArrayHelper::getValue($_SERVER, 'HTTP_AUTH_KEY');

    if (!in_array($actualKey, $allowedKeys)) {
      exit('You shell not pass');
    }
  }
}

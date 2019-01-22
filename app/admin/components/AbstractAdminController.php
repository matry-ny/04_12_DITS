<?php

namespace app\admin\components;

use components\AbstractController;
use components\App;

/**
 * Class AbstractAdminController
 * @package app\admin\components
 */
abstract class AbstractAdminController extends AbstractController
{
  public function __construct()
  {
    $this->checkIsGuest();
  }

  private function checkIsGuest()
  {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
      $this->askAuthentication();
    }

    $user = App::get()->user();
    if ($user->getIsGuest()) {
      $login = $_SERVER['PHP_AUTH_USER'];
      $password = $_SERVER['PHP_AUTH_PW'];
      if ($user->auth($login, $password)->getIsGuest()) {
        $this->askAuthentication();
      }
    }
  }

  protected function askAuthentication()
  {
    header('WWW-Authenticate: Basic realm="My Shop"');
    header('HTTP/1.0 401 Unauthorized');
    exit('You shell not pass!');
  }
}

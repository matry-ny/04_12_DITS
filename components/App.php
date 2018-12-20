<?php

namespace components;

use components\request\web\Request as WebRequest;
use components\request\cli\Request as CliRequest;

/**
 * Class App
 * @package components
 */
class App
{
  /**
   * @var bool
   */
  private $isCli = false;

  /**
   * @var WebRequest|CliRequest
   */
  private $request;

  public function __construct()
  {
    $this->isCli = (php_sapi_name() == 'cli');
    $this->setRequest();
  }

  private function setRequest(): void
  {
    if ($this->isCli) {
      $this->request = new CliRequest();
    } else {
      $this->request = new WebRequest();
    }
  }
}

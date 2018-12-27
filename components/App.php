<?php

namespace components;

use components\request\AbstractRequest;
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
   * @var AbstractRequest
   */
  private $request;

  /**
   * @var array
   */
  private $config;

  /**
   * App constructor.
   * @param array $config
   */
  private function __construct(array $config)
  {
    $this->config = $config;
    $this->isCli = (php_sapi_name() == 'cli');
    $this->setRequest();
  }

  /**
   * @var null|App
   */
  private static $instance = null;

  /**
   * @param array $config
   */
  public static function run(array $config)
  {
    if (null === self::$instance) {
      self::$instance = new self($config);
    }

    $controller = self::$instance->request->getParser()->getController();
    $action = self::$instance->request->getParser()->getAction();

    $controller->runAction($action);

  }

  /**
   * @return App
   * @throws \Exception
   */
  public static function get(): App
  {
    if (null === self::$instance) {
      throw new \Exception('Application is not initialized yet');
    }

    return self::$instance;
  }

  /**
   * @return array
   */
  public function config(): array
  {
    return $this->config;
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

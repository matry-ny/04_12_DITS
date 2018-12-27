<?php

namespace components\request;

use components\AbstractController;
use components\App;
use exceptions\InvalidConfigException;
use exceptions\RequestException;
use helpers\ArrayHelper;
use helpers\StringHelper;

/**
 * Class Parser
 * @package components\request
 */
class Parser
{
  /**
   * @var array
   */
  private $parts;

  /**
   * Parser constructor.
   * @param AbstractRequest $request
   */
  public function __construct(AbstractRequest $request)
  {
    $this->parts = $request->getParts();
  }

  /**
   * @return AbstractController
   * @throws InvalidConfigException
   * @throws RequestException
   * @throws \Exception
   */
  public function getController(): AbstractController
  {
    $namespace = ArrayHelper::getValue(App::get()->config(), 'controllersNamespace');

    if (empty($namespace)) {
      throw new InvalidConfigException('Key "controllersNamespace" is required');
    }

    $controllerPart = ArrayHelper::getValue($this->parts, 0, 'index');
    $controller = StringHelper::camelize($controllerPart);

    $class = "{$namespace}\\{$controller}Controller";

    if (!class_exists($class)) {
      throw new RequestException("Controller '{$class}' is not exists");
    }

    $object = new $class();
    if (!$object instanceof AbstractController) {
      throw new RequestException("Controller '{$class}' is invalid");
    }

    return $object;
  }

  /**
   * @return string
   */
  public function getAction(): string
  {
    $actionPart = ArrayHelper::getValue($this->parts, 1, 'index');
    $action = StringHelper::camelize($actionPart);

    return "action{$action}";
  }
}

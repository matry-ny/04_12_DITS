<?php

namespace components;

use components\db\Query;
use exceptions\RequestException;
use ReflectionMethod;
use ReflectionParameter;

/**
 * Class AbstractController
 * @package components
 */
abstract class AbstractController
{
  /**
   * @param string $action
   * @param array $params
   * @throws RequestException
   */
  public function runAction(string $action, array $params = [])
  {
    if (!method_exists($this, $action)) {
      throw new RequestException("Action '{$action}' is undefined");
    }

    $paramsList = [];
    $reflectionMethod = new ReflectionMethod($this, $action);
    foreach ($reflectionMethod->getParameters() as $argument) {
      if (array_key_exists($argument->getName(), $params)) {
        $paramsList[] = $params[$argument->getName()];
      } else {
        if ($argument->isOptional()) {
          $paramsList[] = $argument->getDefaultValue();
        } else {
          throw new RequestException("Argument '{$argument->getName()}' is required");
        }
      }
    }

    call_user_func_array([$this, $action], $paramsList);
  }

  /**
   * @param string $template
   * @param array $variables
   * @param string $layout
   * @throws \Exception
   */
  public function render(
    string $template,
    array $variables = [],
    string $layout = 'layouts/main'
  ) {
    App::get()->template()->render($template, $variables, $layout);
  }

  /**
   * @return Query
   * @throws \Exception
   */
  public function getQuery(): Query
  {
    return App::get()->db()->getQueryBuilder();
  }
}

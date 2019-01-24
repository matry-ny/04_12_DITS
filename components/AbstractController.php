<?php

namespace components;

use exceptions\RequestException;

/**
 * Class AbstractController
 * @package components
 */
abstract class AbstractController
{
  /**
   * @param string $action
   * @throws RequestException
   */
  public function runAction(string $action)
  {
    if (!method_exists($this, $action)) {
      throw new RequestException("Action '{$action}' is undefined");
    }

    call_user_func_array([$this, $action], []);
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
}

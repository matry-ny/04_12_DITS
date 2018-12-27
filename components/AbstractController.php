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
}

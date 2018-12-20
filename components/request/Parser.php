<?php

namespace components\request;

/**
 * Class Parser
 * @package components\request
 */
class Parser
{
  public function __construct(AbstractRequest $request)
  {
    var_dump(123, $request);
  }
}

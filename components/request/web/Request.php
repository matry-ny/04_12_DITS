<?php

namespace components\request\web;

use components\request\AbstractRequest;
use components\request\Parser;

/**
 * Class Request
 * @package components
 */
class Request extends AbstractRequest
{
  public function __construct()
  {
    $this->address = $this->prepareAddress($_SERVER['REQUEST_URI']);
  }

  /**
   * @param string $address
   * @return string
   */
  protected function prepareAddress(string $address): string
  {
    $paramsStart = stripos($address, '?');
    if ($paramsStart !== false) {
      $address = substr($address, 0, $paramsStart);
    }

    return trim($address, " \t\n\r\0\x0B/");
  }

  /**
   * @return mixed
   */
  public function getParams(): array
  {
    return $_GET;
  }
}

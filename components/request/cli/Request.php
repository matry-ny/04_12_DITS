<?php

namespace components\request\cli;

use components\request\AbstractRequest;
use components\request\Parser;

/**
 * Class Request
 * @package components\request\cli
 */
class Request extends AbstractRequest
{
  public function __construct()
  {
    global $argv;
    $queryString = isset($argv[1]) ? $argv[1] : '';

    $this->address = $this->prepareAddress($queryString);
  }

  /**
   * @param string $address
   * @return string
   */
  protected function prepareAddress(string $address): string
  {
    return trim($address, " \t\n\r\0\x0B/");
  }

  /**
   * @return mixed
   */
  public function getParams(): array
  {
    // ToDo: Implement params parsing
    return [];
  }
}
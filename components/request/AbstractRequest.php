<?php

namespace components\request;

/**
 * Class AbstractRequest
 * @package components\request
 */
abstract class AbstractRequest
{
  /**
   * @var string
   */
  protected $address;

  /**
   * @param string $address
   * @return string
   */
  abstract protected function prepareAddress(string $address): string;
}

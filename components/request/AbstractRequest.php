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
   * @var Parser
   */
  protected $parser;

  /**
   * @return Parser
   */
  public function getParser(): Parser
  {
    if (null === $this->parser) {
      $this->parser = new Parser($this);
    }

    return $this->parser;
  }

  /**
   * @return array
   */
  public function getParts(): array
  {
    return array_filter(explode('/', $this->address));
  }

  /**
   * @return mixed
   */
  abstract public function getParams(): array;

  /**
   * @param string $address
   * @return string
   */
  abstract protected function prepareAddress(string $address): string;
}

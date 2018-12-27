<?php

namespace helpers;

/**
 * Class ArrayHelper
 * @package helpers
 */
class ArrayHelper
{
  /**
   * @param array $data
   * @param string $key
   * @param mixed $default
   * @return mixed
   *
   * todo: modify interface
   * $key: "test.qwerty"
   * $data: ['test' => ['qwerty' => 123]]
   * return: 123
   */
  public static function getValue(array $data, string $key, $default = null)
  {
    return array_key_exists($key, $data) ? $data[$key] : $default;
  }
}

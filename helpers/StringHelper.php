<?php

namespace helpers;

/**
 * Class StringHelper
 * @package helpers
 */
class StringHelper
{
  /**
   * @param string $sting
   * @param bool|true $ucFirst
   * @param string $delimiter
   * @return string
   *
   * todo: refactor to regexp
   */
  public static function camelize(
    string $sting,
    bool $ucFirst = true,
    string $delimiter = '-'
  ): string {
    $camelized = '';
    $parts = explode($delimiter, $sting);
    foreach ($parts as $part) {
      $camelized .= ucfirst($part);
    }

    if (false === $ucFirst) {
      $camelized = lcfirst($camelized);
    }

    return $camelized;
  }
}

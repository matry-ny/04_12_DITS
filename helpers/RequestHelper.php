<?php

namespace helpers;

/**
 * Class RequestHelper
 * @package helpers
 */
class RequestHelper
{
  /**
   * @param string $url
   * @param int $code
   * @param bool|true $terminate
   */
  public static function redirect(
    string $url,
    int $code = 301,
    bool $terminate = true
  ) {
    header("Location: {$url}", true, $code);
    if ($terminate) {
      exit;
    }
  }

  /**
   * @return string
   */
  public static function getSchema(): string
  {
    return $_SERVER['REQUEST_SCHEME'];
  }

  /**
   * @return string
   */
  public static function getDomain(): string
  {
    return $_SERVER['HTTP_HOST'];
  }

  /**
   * @return bool
   */
  public static function getIsPost(): bool
  {
    return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
  }
}

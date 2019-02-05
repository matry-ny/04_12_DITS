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

  /**
   * @param array $filePost
   * @return array
   */
  public static function reArrayFiles(array $filePost): array
  {
    $fileCount = count($filePost['name']);
    $fileKeys = array_keys($filePost);

    $result = [];
    for ($i=0; $i < $fileCount; $i++) {
      foreach ($fileKeys as $key) {
        $result[$i][$key] = $filePost[$key][$i];
      }
    }

    return $result;
  }

}

<?php

namespace widgets;

/**
 * Class DropdownOptions
 * @package widgets
 */
class DropDownOptions
{
  /**
   * @var array
   */
  private $options;

  /**
   * DropDownOptions constructor.
   * @param array $options
   */
  public function __construct(
    array $options,
    string $valueKey,
    string $labelKey
  ) {
    $this->options = $this->prepareData($options, $valueKey, $labelKey);
  }

  public function render()
  {
    foreach ($this->options as $value => $label) {
      echo "<option value='{$value}'>{$label}</option>";
    }
  }

  /**
   * @param array $options
   * @param string $valueKey
   * @param string $labelKey
   * @return \Generator
   */
  private function prepareData(
    array $options,
    string $valueKey,
    string $labelKey
  ) {
    foreach ($options as $option) {
      yield $option[$valueKey] => $option[$labelKey];
    }
  }
}
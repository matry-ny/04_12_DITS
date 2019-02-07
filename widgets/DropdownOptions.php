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

  /**
   * @param null|mixed $selected
   */
  public function render($selected = null)
  {
    foreach ($this->options as $value => $label) {
      $isSelected = $selected == $value ? 'selected' : '';
      echo "<option value='{$value}' {$isSelected}>{$label}</option>";
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
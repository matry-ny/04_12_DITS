<?php

namespace widgets;

/**
 * Class Table
 * @package widgets
 */
class Table
{
  /**
   * @var array
   */
  private $labels;

  /**
   * @var array
   */
  private $data;

  /**
   * Table constructor.
   * @param array $labels
   * @param array $data
   */
  public function __construct(array $labels, array $data)  {
    $this->labels = $labels;
    $this->data = $data;
  }

  public function render()
  {
    $table = '<table class="table"><thead class="thead-dark"><tr>';
    foreach ($this->labels as $label) {
      $table .= "<th>{$label}</th>";
    }
    $table .= '</tr></thead>';
    $table .= '<tbody>';
    foreach ($this->data as $row) {
      $table .= '<tr>';
      foreach ($row as $column) {
        $table .= "<td>{$column}</td>";
      }
      $table .= '</tr>';
    }
    $table .= '</tbody></table>';

    echo $table;
  }
}
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

  /**
   * @param bool|false $withUpdate
   */
  public function render(string $updateUrl = null)
  {
    $table = '<table class="table"><thead class="thead-dark"><tr>';
    foreach ($this->labels as $label) {
      $table .= "<th>{$label}</th>";
    }
    $table .= $updateUrl ? $this->renderUpdateHead() : '';
    $table .= '</tr></thead>';
    $table .= '<tbody>';
    foreach ($this->data as $row) {
      $table .= '<tr>';
      foreach ($row as $column) {
        $table .= "<td>{$column}</td>";
      }

      if ($updateUrl) {
        $url = "{$updateUrl}?id={$row['id']}";
        $table .= $this->renderUpdateColumn($url);
      }


      $table .= '</tr>';
    }
    $table .= '</tbody></table>';

    echo $table;
  }

  /**
   * @return string
   */
  private function renderUpdateHead(): string
  {
    return '<th></th>';
  }

  /**
   * @param string $updateUrl
   * @return string
   */
  private function renderUpdateColumn(string $updateUrl): string
  {
    return "<td><a href='{$updateUrl}' class='btn btn-xs btn-primary'>Update</a></td>";
  }
}
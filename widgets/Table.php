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
  public function __construct(array $labels, array $data) {
    $this->labels = $labels;
    $this->data = $data;
  }

  /**
   * @param string|null $updateUrl
   * @param string|null $deleteUrl
   */
  public function render(string $updateUrl = null, string $deleteUrl = null)
  {
    $table = '<table class="table"><thead class="thead-dark"><tr>';
    foreach ($this->labels as $label) {
      $table .= "<th>{$label}</th>";
    }
    $table .= $updateUrl ? $this->renderEmptyTh() : '';
    $table .= $deleteUrl ? $this->renderEmptyTh() : '';
    $table .= '</tr></thead>';
    $table .= '<tbody>';
    foreach ($this->data as $row) {
      $table .= '<tr>';
      foreach ($row as $column) {
        $table .= "<td>{$column}</td>";
      }

      if ($updateUrl) {
        $url = "{$updateUrl}?id={$row['id']}";
        $table .= $this->renderActionColumn($url, 'Update', 'primary');
      }

      if ($deleteUrl) {
        $url = "{$deleteUrl}?id={$row['id']}";
        $table .= $this->renderActionColumn($url, 'Delete', 'danger');
      }

      $table .= '</tr>';
    }
    $table .= '</tbody></table>';

    echo $table;
  }

  /**
   * @return string
   */
  private function renderEmptyTh(): string
  {
    return '<th></th>';
  }

  /**
   * @param string $updateUrl
   * @param string $label
   * @param string $class
   * @return string
   */
  private function renderActionColumn(
    string $updateUrl,
    string $label,
    string $class
  ): string
  {
    return "<td><a href='{$updateUrl}' class='btn btn-xs btn-{$class}'>{$label}</a></td>";
  }
}
<?php

namespace components\db\builder;

use components\App;

/**
 * Class Delete
 * @package components\db\builder
 */
class Delete
{
  /**
   * @var
   */
  private $table;

  /**
   * @var array
   */
  private $conditions = [];

  /**
   * @var string
   */
  private $delimiter = 'AND';

  /**
   * @param string $table
   * @return Delete
   */
  public function from(string $table): Delete
  {
    $this->table = $table;
    return $this;
  }

  /**
   * @param array $conditions
   * @param string $delimiter
   * @return Delete
   */
  public function where(array $conditions, string $delimiter = 'AND'): Delete
  {
    $this->conditions = $conditions;
    $this->delimiter = $delimiter;
    return $this;
  }

  private function buildQuery()
  {
    $sql = "DELETE FROM {$this->table}";
    if ($this->conditions) {
      $sql .= ' WHERE ' . implode(" {$this->delimiter} ", $this->conditions);
    }

    return $sql;
  }

  /**
   * @return bool
   * @throws \Exception
   */
  public function execute(): bool
  {
    return App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare($this->buildQuery())
      ->execute();
  }
}

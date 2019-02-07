<?php

namespace components\db\builder;

use components\App;

/**
 * Class Update
 * @package components\db\builder
 */
class Update
{
  /**
   * @var array
   */
  private $fields;

  /**
   * @var string
   */
  private $table;

  /**
   * @var array
   */
  private $conditions = [];

  /**
   * @var string
   */
  private $delimiter = 'and';

  /**
   * Update constructor.
   * @param array $fields
   */
  public function __construct(array $fields)
  {
    $this->fields = $fields;
  }

  /**
   * @param string $table
   * @return Update
   */
  public function into(string $table): Update
  {
    $this->table = $table;
    return $this;
  }

  /**
   * @param array $conditions
   * @param string $delimiter
   * @return Update
   */
  public function where(array $conditions, string $delimiter = 'and'): Update
  {
    $this->conditions = $conditions;
    $this->delimiter = $delimiter;
    return $this;
  }

  private function getQuery()
  {
    $fields = [];
    foreach($this->fields as $key => $value) {
      $fields[] = "{$key} = :{$key}";
    }
    $fields = implode(', ', $fields);

    $sql = "UPDATE {$this->table} SET {$fields}";
    if ($this->conditions) {
      $sql .= ' WHERE ' . implode(" {$this->delimiter} ", $this->conditions);
    }

    $query = App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare($sql);

    foreach ($this->fields as $key => $value) {
      $query->bindValue(":{$key}", $value);
    }

    return $query;
  }

  /**
   * @return bool
   */
  public function execute(): bool
  {
    return $this->getQuery()->execute();
  }
}

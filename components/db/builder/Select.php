<?php

namespace components\db\builder;

use components\App;
use PDO;
use PDOStatement;

/**
 * Class Select
 * @package components\db\builder
 */
class Select
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
  private $conditions;

  /**
   * @var string
   */
  private $delimiter = 'and';

  /**
   * Select constructor.
   * @param array $fields
   */
  public function __construct(array $fields)
  {
    $this->fields = $fields;
  }

  /**
   * @param string $table
   * @return Select
   */
  public function from(string $table): Select
  {
    $this->table = $table;
    return $this;
  }

  /**
   * @param array $conditions
   * @param string $delimiter
   * @return Select
   */
  public function where(array $conditions, string $delimiter = 'and'): Select
  {
    $this->conditions = $conditions;
    $this->delimiter = $delimiter;

    return $this;
  }

  /**
   * @return string
   */
  public function getRawSql(): string
  {
    $fields = implode(', ', $this->fields);
    $sql = "SELECT {$fields} FROM {$this->table}";
    if ($this->conditions) {
      $sql .= ' WHERE ' . implode(" {$this->delimiter} ", $this->conditions);
    }

    return $sql;
  }

  /**
   * @return PDOStatement
   * @throws \Exception
   */
  private function getQuery(): PDOStatement
  {
    return App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare($this->getRawSql());
  }

  public function fetchAll(): array
  {
    $query = $this->getQuery();
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * @return mixed
   */
  public function fetchOne(): array
  {
    $query = $this->getQuery();
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
  }
}

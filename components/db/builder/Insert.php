<?php

namespace components\db\builder;

use Exception;
use PDOStatement;
use components\App;

/**
 * Class Insert
 * @package components\db\builder
 */
class Insert
{
  /**
   * @var string
   */
  private $table;

  /**
   * @var array
   */
  private $fields;

  /**
   * Insert constructor.
   * @param array $values
   */
  public function __construct(array $values)
  {
    $this->fields = $values;
  }

  /**
   * @param string $table
   * @return Insert
   */
  public function into(string $table): Insert
  {
    $this->table = $table;
    return $this;
  }

  /**
   * @return PDOStatement
   * @throws Exception
   */
  private function getQuery(): PDOStatement
  {
    $columns = implode(', ', array_keys($this->fields));
    $values = [];
    foreach ($this->fields as $key => $value) {
      $values[] = ":{$key}";
    }
    $values = implode(', ', $values);

    $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
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
   * @return int
   * @throws Exception
   */
  public function execute(): int
  {
    try {
      App::get()->db()->getConnection()->beginTransaction();

      $this->getQuery()->execute();
      $lastId = App::get()->db()->getConnection()->lastInsertId();

      App::get()->db()->getConnection()->commit();
    } catch (Exception $ex) {
      App::get()->db()->getConnection()->rollBack();
      die($ex->getMessage());
    }

    return (int)$lastId;
  }
}
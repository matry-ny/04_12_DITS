<?php

namespace components\db;

use components\db\builder\Delete;
use components\db\builder\Insert;
use components\db\builder\Select;
use components\db\builder\Update;
use PDO;
use PDOStatement;

/**
 * Class Query
 * @package components\db
 */
class Query
{
  /**
   * @var PDO
   */
  public $dbConnection;

  /**
   * Query constructor.
   * @param PDO $dbConnection
   */
  public function __construct(PDO $dbConnection)
  {
    $this->dbConnection = $dbConnection;
  }

  /**
   * @param string $sql
   * @return PDOStatement
   */
  public function prepare(string $sql): PDOStatement
  {
    return $this->dbConnection->prepare($sql);
  }

  /**
   * @param array $fields
   * @return Select
   */
  public function select(array $fields): Select
  {
    return new Select($fields);
  }

  /**
   * @param array $fields
   * @return Update
   */
  public function update(array $fields): Update
  {
    return new Update($fields);
  }

  /**
   * @return Insert
   */
  public function insert(array $fields): Insert
  {
    return new Insert($fields);
  }

  /**
   * @return Delete
   */
  public function delete(): Delete
  {
    return new Delete();
  }
}

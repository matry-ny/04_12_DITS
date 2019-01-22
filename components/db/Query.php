<?php

namespace components\db;

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
}

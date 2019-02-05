<?php

namespace components\db;

use PDO;

/**
 * Class Database
 * @package components\db
 */
class Database
{
  /**
   * @var string
   */
  private $host;

  /**
   * @var string
   */
  private $user;

  /**
   * @var string
   */
  private $password;

  /**
   * @var string
   */
  private $dbName;

  /**
   * @var \PDO
   */
  private $connection;

  /**
   * Database constructor.
   * @param string $host
   * @param string $user
   * @param string $password
   * @param string $dbName
   */
  public function __construct(
    string $host,
    string $user,
    string $password,
    string $dbName
  ) {
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
    $this->dbName = $dbName;
  }

  /**
   * @return PDO
   */
  public function getConnection(): PDO
  {
    if (null === $this->connection) {
      $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
      $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

      $this->connection = new PDO($dsn, $this->user, $this->password, $options);
    }

    return $this->connection;
  }

  /**
   * @var null|Query
   */
  private $queryBuilder = null;

  /**
   * @return Query
   */
  public function getQueryBuilder(): Query
  {
    if (null === $this->queryBuilder) {
      $this->queryBuilder = new Query($this->getConnection());
    }

    return $this->queryBuilder;
  }
}

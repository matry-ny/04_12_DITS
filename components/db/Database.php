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

    $this->connection = $this->getConnection();
  }

  /**
   * @return PDO
   */
  private function getConnection(): PDO
  {
    $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

    return new PDO($dsn, $this->user, $this->password, $options);
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
      $this->queryBuilder = new Query($this->connection);
    }

    return $this->queryBuilder;
  }
}

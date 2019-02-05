<?php

namespace components\db;

use helpers\ArrayHelper;
use PDO;
use components\App;

/**
 * Class AbstractModel
 * @package components\db
 */
abstract class AbstractModel
{
  /**
   * @return string
   */
  abstract public function tableName(): string;

  /**
   * @return array
   * @throws \Exception
   */
  public function find(): array
  {
    $products = App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare("SELECT * FROM {$this->tableName()}");

    $products->execute();

    return $products->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * @param array $data
   * @return int
   * @throws \Exception
   */
  public function create(array $data): int
  {
    $columns = implode(', ', array_keys($data));
    $values = [];
    foreach ($data as $key => $value) {
      $values[] = ":{$key}";
    }
    $values = implode(', ', $values);

    $sql = <<<SQL
INSERT INTO {$this->tableName()} ({$columns}) VALUES ({$values})
SQL;

    $query = App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare($sql);

    foreach ($data as $key => $value) {
      $query->bindValue(":{$key}", $value);
    }

    $query->execute();

    return (int)App::get()->db()->getConnection()->lastInsertId();
  }
}

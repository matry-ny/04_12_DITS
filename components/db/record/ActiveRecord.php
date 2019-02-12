<?php

namespace components\db\record;

use components\App;

/**
 * Class ActiveRecord
 * @package components\db\record
 */
abstract class ActiveRecord
{
  /**
   * @var array
   */
  private $attributes = [];

  /**
   * @return string
   */
  abstract protected function tableName(): string;

  public function __construct()
  {
    $this->initAttributes();
  }

  /**
   * @param string $name
   * @return null
   */
  public function __get(string $name)
  {
    if (array_key_exists($name, $this->attributes)) {
      return $this->attributes[$name];
    }

    return null;
  }

  /**
   * @param $primaryKey
   * @return static
   * @throws \Exception
   * @throws \components\db\DbException
   */
  public static function findOne($primaryKey)
  {
    $model = new static();

    $primaryKeyColumn = App::get()
      ->db()
      ->getPrimaryKey($model->tableName());

    $data = App::get()
      ->db()
      ->getQueryBuilder()
      ->select(['*'])
      ->from($model->tableName())
      ->where(["{$primaryKeyColumn} = {$primaryKey}"])
      ->fetchOne();

    $model->fillAttributes($data);
    return $model;
  }

  private function initAttributes(): void
  {
    $columns = App::get()->db()->getColumns($this->tableName());
    foreach($columns as $column) {
      $this->attributes[$column] = null;
    }
  }

  /**
   * @param array $data
   */
  private function fillAttributes(array $data): void
  {
    foreach($data as $field => $value) {
      if (!array_key_exists($field, $this->attributes)) {
        continue;
      }

      $this->attributes[$field] = $value;
    }
  }
}

<?php

namespace components\db\record;

use Iterator;
use ArrayAccess;
use components\App;

/**
 * Class ActiveRecord
 * @package components\db\record
 */
abstract class ActiveRecord implements ArrayAccess, Iterator
{
  /**
   * @var array
   */
  private $attributes = [];

  /**
   * @var bool
   */
  private $isNewRecord = true;

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

    $model->load($data);

    $model->isNewRecord = false;

    return $model;
  }

  /**
   * @return static[]
   * @throws \Exception
   */
  public static function findAll(): array
  {
    $data = App::get()
      ->db()
      ->getQueryBuilder()
      ->select(['*'])
      ->from((new static())->tableName())
      ->fetchAll();

    $models = [];
    foreach($data as $row) {
      $model = new static();
      $model->load($row);

      $model->isNewRecord = false;

      $models[] = $model;
    }

    return $models;
  }

  public function save()
  {
    if ($this->isNewRecord) {
      $this->insert();
    } else {
      $this->update();
    }
  }

  public function insert()
  {
    $id = App::get()
      ->db()
      ->getQueryBuilder()
      ->insert($this->attributes)
      ->into($this->tableName())
      ->execute();

    $newModel = self::findOne($id);
    $this->load($newModel->attributes);
    unset($newModel);
  }

  public function update()
  {
    $field = App::get()->db()->getPrimaryKey($this->tableName());
    $primary = $this->attributes[$field];

    App::get()
      ->db()
      ->getQueryBuilder()
      ->update($this->attributes)
      ->into($this->tableName())
      ->where(["{$field} = {$primary}"])
      ->execute();


    $newModel = self::findOne($primary);
    $this->load($newModel->attributes);
    unset($newModel);
  }

  public function delete()
  {
    $field = App::get()->db()->getPrimaryKey($this->tableName());
    $primary = $this->attributes[$field];

    App::get()
      ->db()
      ->getQueryBuilder()
      ->delete()
      ->from($this->tableName())
      ->where(["{$field} = {$primary}"])
      ->execute();

    $this->initAttributes();
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
  public function load(array $data): void
  {
    foreach($data as $field => $value) {
      if (!array_key_exists($field, $this->attributes)) {
        continue;
      }

      $this->attributes[$field] = $value;
    }
  }

  /**
   * @param mixed $offset
   * @return bool
   */
  public function offsetExists($offset)
  {
    return array_key_exists($offset, $this->attributes);
  }

  /**
   * @param mixed $offset
   * @return mixed
   */
  public function offsetGet($offset)
  {
    return $this->attributes[$offset];
  }

  /**
   * @param mixed $offset
   * @param mixed $value
   */
  public function offsetSet($offset, $value)
  {
    $this->attributes[$offset] = $value;
  }

  /**
   * @param mixed $offset
   */
  public function offsetUnset($offset)
  {
    $this->attributes[$offset] = null;
  }

  /**
   * @var string
   */
  private $iterator;

  /**
   * @return mixed
   */
  public function current()
  {
    return $this->attributes[$this->key()];
  }

  public function next()
  {
    $keys = array_keys($this->attributes);
    $currentIndex = array_search($this->iterator, $keys);

    $nextIndex = ++$currentIndex;
    if (array_key_exists($nextIndex, $keys)) {
      $this->iterator = $keys[$nextIndex];
    } else {
      $this->iterator = '';
    }
  }

  /**
   * @return string
   */
  public function key()
  {
    return $this->iterator;
  }

  /**
   * @return bool
   */
  public function valid()
  {
    return array_key_exists($this->key(), $this->attributes);
  }

  public function rewind()
  {
    $this->iterator = array_keys($this->attributes)[0];
  }
}

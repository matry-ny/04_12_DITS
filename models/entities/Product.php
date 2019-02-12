<?php

namespace models\entities;

use components\db\record\ActiveRecord;

/**
 * Class Product
 * @package models\entities
 *
 * @property int $id
 * @property string $title
 * @property int $author_id
 * @property float $price
 * @property string $created_at
 */
class Product extends ActiveRecord
{
  /**
   * @return string
   */
  protected function tableName(): string
  {
    return 'products';
  }
}
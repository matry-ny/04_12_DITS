<?php

namespace models;

use components\db\AbstractModel;

/**
 * Class Products
 * @package models
 */
class Products extends AbstractModel
{
  /**
   * @return string
   */
  public function tableName(): string
  {
    return 'products';
  }
}

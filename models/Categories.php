<?php

namespace models;

use components\db\AbstractModel;

/**
 * Class Categories
 * @package models
 */
class Categories extends AbstractModel
{
  /**
   * @return string
   */
  public function tableName(): string
  {
    return 'cathegories';
  }
}

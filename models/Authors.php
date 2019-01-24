<?php

namespace models;

use components\db\AbstractModel;

/**
 * Class Author
 * @package models
 */
class Authors extends AbstractModel
{
  /**
   * @return string
   */
  public function tableName(): string
  {
    return 'authors';
  }
}

<?php

namespace models;

use components\App;
use components\db\AbstractModel;
use PDO;

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

  /**
   * @return array
   * @throws \Exception
   */
  public function getPretty(): array
  {
    $sql = <<<SQL
SELECT
  p.id,
  p.title,
  a.name as author,
  p.price
FROM products p
INNER JOIN authors a ON (a.id = p.author_id)
SQL;

    $query = App::get()->db()->getQueryBuilder()->prepare($sql);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}

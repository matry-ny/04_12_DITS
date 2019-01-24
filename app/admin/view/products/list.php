<?php

use widgets\Table;

/**
 * @var array $products
 */

(new Table(
  ['ID', 'Title', 'Author ID', 'Price', 'Created At'],
  $products)
)->render();

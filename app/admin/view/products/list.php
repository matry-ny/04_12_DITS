<?php

use widgets\Table;

/**
 * @var array $products
 */

?>

<a href="/products/create" class="btn btn-success">Add New Product</a>

<?php (new Table(
  ['ID', 'Title', 'Author ID', 'Price', 'Created At'],
  $products
))->render("/products/update");

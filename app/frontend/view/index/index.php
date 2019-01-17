<?php

/**
 * @var array $products
 */

?>

<h1>Products</h1>
<table class="table">
  <thead class="thead-dark">
  <tr>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">Price</th>
  </tr>
  </thead>
  <?php foreach ($products as $product) : ?>
    <tr>
      <td><?= $product['id'] ?></td>
      <td><?= $product['title'] ?></td>
      <td>$<?= $product['price'] ?></td>
    </tr>
  <?php endforeach ?>
</table>
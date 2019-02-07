<?php

use widgets\DropDownOptions;

/**
 * @var array $product
 * @var array $authors
 */

?>
<form method="post">
  <label for="product-title">Title</label>
  <input type="text"
         name="title"
         value="<?= $product['title'] ?>"
         class="form-control"
         id="product-title">

  <label for="product-author-id">Author</label>
  <select class="form-control" name="author_id" id="product-author-id">
    <?php
      (new DropDownOptions($authors, 'id', 'name'))
        ->render($product['author_id'])
    ?>
  </select>

  <label for="product-price">Price</label>
  <input type="number"
         step="0.25"
         min="0"
         name="price"
         value="<?= $product['price'] ?>"
         class="form-control"
         id="product-price">

  <input type="submit" class="btn btn-success" value="Update">
</form>

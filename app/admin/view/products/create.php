<?php

use widgets\DropDownOptions;

/**
 * @var array $authors
 */

?>

<form method="post">
  <label for="product-title">Title</label>
  <input type="text" name="title" class="form-control" id="product-title">

  <label for="product-author-id">Author</label>
  <select class="form-control" name="author_id" id="product-author-id">
    <?php (new DropDownOptions($authors, 'id', 'name'))->render() ?>
  </select>

  <label for="product-price">Price</label>
  <input type="number"
         step="0.25"
         min="0"
         name="price"
         class="form-control"
         id="product-price">

  <input type="submit" class="btn btn-success" value="Add">
</form>
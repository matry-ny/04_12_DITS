<?php

use widgets\DropDownOptions;

/**
 * @var array $authors
 */

?>

<form method="post" enctype="multipart/form-data">
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

  <label for="product-images">Images</label>
  <div class="input-group">
    <div class="custom-file">
      <input type="file"
             name="images[]"
             class="custom-file-input"
             id="product-images"
             aria-describedby="inputGroupFileAddon04"
             accept="image/png, image/jpeg"
             multiple>
      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
    </div>
  </div>

  <input type="submit" class="btn btn-success" value="Add">
</form>
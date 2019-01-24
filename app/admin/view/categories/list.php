<?php

use widgets\Table;

/**
 * @var array $categories
 */

?>

<a href="/categories/create" class="btn btn-success">Create Category</a>

<?php (new Table(['ID', 'Title'], $categories))->render() ?>

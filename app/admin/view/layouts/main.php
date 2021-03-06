<?php

use helpers\RequestHelper;

/**
 * @var string $content
 */

$logoutUrl = vsprintf('%s://logout-%s@%s', [
  RequestHelper::getSchema(),
  md5(time() . mt_rand()),
  RequestHelper::getDomain()
]);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop</title>

  <!-- Bootstrap core CSS -->
  <link href="/public/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="/public/css/dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">BOOK Shop</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?= $logoutUrl ?>">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/">
              <span data-feather="home"></span>Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/products/list">
              <span data-feather="file"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/categories/list">
              <span data-feather="file"></span>
              Categories
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <?= $content ?>
    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="/public/js/bootstrap.min.js"></script>

</body>
</html>

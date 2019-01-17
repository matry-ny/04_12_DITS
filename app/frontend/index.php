<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$config = array_merge(
  require_once __DIR__ . '/../../configs/common.php',
  require_once __DIR__ . '/../../configs/frontent.php'
);

components\App::run($config);

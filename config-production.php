<?php

use ComposePress\Dice\Dice;
use Wpify\Plugin;

$defaults = include __DIR__ . '/vendor/wpify/core/src/config-default.php';


/** @var Dice $container */
$container = $container->addRules(
  array_merge_recursive(
    $defaults,
    [
      Plugin::class => ['shared' => true],
    ]
  )
);

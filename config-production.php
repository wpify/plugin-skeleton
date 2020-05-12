<?php

use ComposePress\Dice\Dice;
use Wpify\Plugin;

/** @var Dice $container */
$container = $container->addRules([
  Plugin::class => ['shared' => true],
]);

<?php

/* @var $container \ComposePress\Dice\Dice */

$container = $container->addRules([
  '*' => [
    'shared' => true,
  ],
  '\Wpify\Models\Lecture' => [
    'shared' => false,
  ],
]);

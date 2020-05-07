<?php

/* @var $container \ComposePress\Dice\Dice */

use Wpify\Models\Lecture;

$container = $container->addRules([
  '*' => [
    'shared' => true,
  ],
  Lecture::class => [
    'shared' => false,
  ],
]);

<?php

use ComposePress\Dice\Dice;
use Wpify\Plugin;
use Wpify\View;

/** @var Dice $container */
$container = $container->addRules(
  [
    Plugin::class => ['shared' => true],
    View::class   => [
      'substitutions' => [
        'ComposePress\Views\Interfaces\ViewEngine' => '\Wpify\ViewEngineWordpress',
      ],
    ],
  ]
);

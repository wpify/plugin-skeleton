<?php

/* @var $container Dice */

use ComposePress\Dice\Dice;
use Wpify\Cpt\MyPostType;
use Wpify\CustomFieldsFactory;
use Wpify\Models\Lecture;

$container = $container->addRules(
  [
    '*'                        => [
      'shared' => true,
    ],
    Lecture::class             => [
      'shared' => false,
    ],
    MyPostType::class          => [
      'shared' => false,
    ],
    CustomFieldsFactory::class => [
      'shared' => false,
    ],
  ]
);

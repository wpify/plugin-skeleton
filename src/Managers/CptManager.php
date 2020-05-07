<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;
use Wpify\Cpt\MyPostType;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property MyPostType $MyPostType
 */
class CptManager extends Manager
{
  protected $modules = [
    MyPostType::class,
  ];
}

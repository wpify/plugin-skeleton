<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Cpt\MyPostType;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property MyPostType $MyPostType
 */
class CptManager extends AbstractManager
{
  protected $modules = [
    MyPostType::class,
  ];
}

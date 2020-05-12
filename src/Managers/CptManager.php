<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Cpt\BookPostType;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property BookPostType $MyPostType
 */
class CptManager extends AbstractManager
{
  protected $modules = [
    BookPostType::class,
  ];
}

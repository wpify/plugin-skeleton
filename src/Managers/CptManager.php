<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;
use Wpify\Cpt\MyPostType;

class CptManager extends Manager
{

  const MODULE_NAMESPACE = '\Wpify\Cpt';

  protected $modules = [
    MyPostType::class,
  ];
}

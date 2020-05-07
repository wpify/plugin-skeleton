<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;

class CptManager extends Manager
{

  const MODULE_NAMESPACE = '\Wpify\Cpt';

  protected $modules = [
    'MyPostType',
  ];
}

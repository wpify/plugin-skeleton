<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Repositories\MyPostTypeRepository;
use Wpify\Repositories\MyTaxonomyRepository;

/**
 * Class RepositoriesManager
 * @package Wpify\Managers
 */
class RepositoriesManager extends AbstractManager
{
  protected $modules = [
    MyPostTypeRepository::class,
    MyTaxonomyRepository::class,
  ];
}

<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;
use Wpify\Repositories\LectureRepository;
use Wpify\Repositories\MyPostTypeRepository;

/**
 * Class RepositoriesManager
 * @package Wpify\Managers
 * @property LectureRepository $LectureRepository
 */
class RepositoriesManager extends Manager
{

  const MODULE_NAMESPACE = '\Wpify\Repositories';

  protected $modules = [
    LectureRepository::class,
    MyPostTypeRepository::class,
  ];
}

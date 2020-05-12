<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Repositories\BookRepository;
use Wpify\Repositories\BookshelfRepository;

/**
 * Class RepositoriesManager
 * @package Wpify\Managers
 */
class RepositoriesManager extends AbstractManager
{
  protected $modules = [
    BookRepository::class,
    BookshelfRepository::class,
  ];
}

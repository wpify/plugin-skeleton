<?php

namespace WpifyPlugin\Managers;

use WpifyPlugin\Plugin;
use WpifyPlugin\Repositories\BookRepository;
use WpifyPlugin\Repositories\BookshelfRepository;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractManager;

/**
 * Class RepositoriesManager
 *
 * @package Wpify\Managers
 * @property Plugin $plugin
 */
class RepositoriesManager extends AbstractManager {
  protected $modules = array(
    BookRepository::class,
    BookshelfRepository::class,
  );
}

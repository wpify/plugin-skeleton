<?php

namespace WpifyPlugin\Managers;

use Wpify\Core_4_0\Abstracts\AbstractManager;
use WpifyPlugin\Plugin;
use WpifyPlugin\Repositories\BookRepository;
use WpifyPlugin\Repositories\BookshelfRepository;

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

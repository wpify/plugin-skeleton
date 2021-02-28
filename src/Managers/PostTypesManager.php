<?php

namespace WpifyPlugin\Managers;

use WpifyPlugin\Plugin;
use WpifyPlugin\PostTypes\BookPostType;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractManager;

/**
 * Class CptManager
 *
 * @package Wpify\Managers
 * @property Plugin $plugin
 * @property BookPostType $MyPostType
 */
class PostTypesManager extends AbstractManager {
  protected $modules = array(
    BookPostType::class,
  );
}

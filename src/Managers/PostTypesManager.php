<?php

namespace WpifyPlugin\Managers;

use Wpify\Core_2_0\Abstracts\AbstractManager;
use WpifyPlugin\PostTypes\BookPostType;
use WpifyPlugin\Plugin;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property Plugin $plugin
 * @property BookPostType $MyPostType
 */
class PostTypesManager extends AbstractManager
{
  protected $modules = [
    BookPostType::class,
  ];
}

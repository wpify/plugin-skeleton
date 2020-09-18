<?php

namespace WpifyPlugin\Managers;

use Wpify\Core\Abstracts\AbstractManager;
use WpifyPlugin\Cpt\BookPostType;
use WpifyPlugin\Plugin;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property Plugin $plugin
 * @property BookPostType $MyPostType
 */
class CptManager extends AbstractManager
{
  protected $modules = [
    BookPostType::class,
  ];
}

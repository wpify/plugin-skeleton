<?php

namespace WpifyPlugin\Repositories;

use ComposePress\Core\Exception\Plugin;
use Wpify\Core\Abstracts\AbstractPostTypeRepository;
use WpifyPlugin\Cpt\BookPostType;

/**
 * @property Plugin $plugin
 */
class BookRepository extends AbstractPostTypeRepository
{
  public function post_type(): BookPostType
  {
    return $this->plugin->get_cpt(BookPostType::class);
  }
}

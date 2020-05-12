<?php

namespace Wpify\Repositories;

use Wpify\Core\AbstractPostTypeRepository;
use Wpify\Cpt\BookPostType;

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

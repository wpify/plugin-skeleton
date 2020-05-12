<?php

namespace Wpify\Repositories;

use Wpify\Core\AbstractTaxonomyRepository;
use Wpify\Taxonomies\BookshelfTaxonomy;

/**
 * @property Plugin $plugin
 */
class BookshelfRepository extends AbstractTaxonomyRepository
{
  public function taxonomy(): BookshelfTaxonomy
  {
    return $this->plugin->get_taxonomy(BookshelfTaxonomy::class);
  }
}

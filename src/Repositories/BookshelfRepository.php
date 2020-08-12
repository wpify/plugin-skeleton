<?php

namespace WpifyPlugin\Repositories;

use Wpify\Core\AbstractTaxonomyRepository;
use WpifyPlugin\Plugin;
use WpifyPlugin\Taxonomies\BookshelfTaxonomy;

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

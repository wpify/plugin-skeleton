<?php

namespace WpifyPlugin\Repositories;

use WpifyPlugin\Plugin;
use WpifyPlugin\Taxonomies\BookshelfTaxonomy;
use Wpify\Core\Abstracts\AbstractTaxonomyRepository;

/**
 * @property Plugin $plugin
 */
class BookshelfRepository extends AbstractTaxonomyRepository {

  public function taxonomy(): BookshelfTaxonomy {
    return $this->plugin->get_taxonomy( BookshelfTaxonomy::class );
  }
}

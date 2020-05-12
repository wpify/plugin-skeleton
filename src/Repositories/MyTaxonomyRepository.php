<?php

namespace Wpify\Repositories;

use Wpify\Core\AbstractTaxonomyRepository;
use Wpify\Taxonomies\MyTaxonomy;

/**
 * @property Plugin $plugin
 */
class MyTaxonomyRepository extends AbstractTaxonomyRepository
{
  public function taxonomy(): MyTaxonomy
  {
    return $this->plugin->get_taxonomy(MyTaxonomy::class);
  }
}

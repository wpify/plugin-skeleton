<?php

namespace Wpify\Repositories;

use Doctrine\Common\Collections\ArrayCollection;
use Wpify\Core\TaxonomyRepository;
use Wpify\Taxonomies\MyTaxonomy;

class MyTaxonomyRepository extends TaxonomyRepository
{
  public function taxonomy(): MyTaxonomy
  {
    return $this->plugin->get_taxonomy(MyTaxonomy::class);
  }
}

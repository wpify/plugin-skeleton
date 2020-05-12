<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Taxonomies\BookshelfTaxonomy;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property BookshelfTaxonomy $MyTaxonomy
 */
class TaxonomiesManager extends AbstractManager
{
  protected $modules = [
    BookshelfTaxonomy::class,
  ];
}

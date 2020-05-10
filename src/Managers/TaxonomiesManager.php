<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;
use Wpify\Taxonomies\MyTaxonomy;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property MyTaxonomy $MyTaxonomy
 */
class TaxonomiesManager extends Manager
{
  protected $modules = [
    MyTaxonomy::class,
  ];
}

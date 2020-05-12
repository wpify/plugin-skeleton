<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Taxonomies\MyTaxonomy;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property MyTaxonomy $MyTaxonomy
 */
class TaxonomiesManager extends AbstractManager
{
  protected $modules = [
    MyTaxonomy::class,
  ];
}

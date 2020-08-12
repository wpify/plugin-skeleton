<?php

namespace WpifyPlugin\Managers;

use Wpify\Core\AbstractManager;
use WpifyPlugin\Plugin;
use WpifyPlugin\Taxonomies\BookshelfTaxonomy;

/**
 * Class CptManager
 * @package Wpify\Managers
 * @property Plugin $plugin
 * @property BookshelfTaxonomy $MyTaxonomy
 */
class TaxonomiesManager extends AbstractManager
{
  protected $modules = [
    BookshelfTaxonomy::class,
  ];
}

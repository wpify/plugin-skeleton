<?php

namespace WpifyPlugin\Managers;

use WpifyPlugin\Plugin;
use WpifyPlugin\Taxonomies\BookshelfTaxonomy;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractManager;

/**
 * Class CptManager
 *
 * @package Wpify\Managers
 * @property Plugin $plugin
 * @property BookshelfTaxonomy $MyTaxonomy
 */
class TaxonomiesManager extends AbstractManager {

  protected $modules = array(
    BookshelfTaxonomy::class,
  );
}

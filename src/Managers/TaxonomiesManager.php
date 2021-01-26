<?php

namespace WpifyPlugin\Managers;

use Wpify\Core_4_0\Abstracts\AbstractManager;
use WpifyPlugin\Plugin;
use WpifyPlugin\Taxonomies\BookshelfTaxonomy;

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

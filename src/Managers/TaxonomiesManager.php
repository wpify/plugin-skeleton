<?php

namespace WpifyPluginSkeleton\Managers;

use WpifyPluginSkeleton\Taxonomies\BookshelfTaxonomy;
use WpifyPluginSkeleton\Taxonomies\LayoutTaxonomy;

final class TaxonomiesManager {
	public function __construct(
		BookshelfTaxonomy $bookshelf_taxonomy,
		LayoutTaxonomy $layout_taxonomy
	) {
	}
}

<?php

namespace WpifyPluginSkeleton\Repositories;

use WpifyPluginSkeleton\Models\PublisherModel;
use WpifyPluginSkeleton\Taxonomies\PublisherTaxonomy;
use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractTermRepository;

class PublisherRepository extends AbstractTermRepository {
	static function taxonomy(): string {
		return PublisherTaxonomy::KEY;
	}

	public function model(): string {
		return PublisherModel::class;
	}
}

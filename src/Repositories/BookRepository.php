<?php

namespace WpifyPluginSkeleton\Repositories;

use WpifyPluginSkeleton\Models\BookModel;
use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractPostRepository;

class BookRepository extends AbstractPostRepository {
	/**
	 * @inheritDoc
	 */
	static function post_type(): string {
		return BookPostType::KEY;
	}

	/**
	 * @inheritDoc
	 */
	public function model(): string {
		return BookModel::class;
	}
}

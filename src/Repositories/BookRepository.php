<?php

namespace WpifyPluginSkeleton\Repositories;

use WpifyPluginSkeleton\Models\BookModel;
use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractPostRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\CategoryRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\PostRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\PostTagRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\UserRepository;

/**
 * @method BookModel get( $object = null )
 */
class BookRepository extends PostRepository {
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

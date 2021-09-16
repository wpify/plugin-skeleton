<?php

namespace WpifyPluginSkeleton\Repositories;

use WpifyPluginSkeleton\Models\BookModel;
use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractPostRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\CategoryRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\PostTagRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\UserRepository;

class BookRepository extends AbstractPostRepository {
	public function __construct(
		UserRepository $user_repository,
		CategoryRepository $category_repository,
		PostTagRepository $post_tag_repository
	) {
		$this->user_repository     = $user_repository;
		$this->category_repository = $category_repository;
		$this->post_tag_repository = $post_tag_repository;
	}

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

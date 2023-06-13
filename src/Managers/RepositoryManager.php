<?php

namespace WpifyPluginSkeleton\Managers;

use WpifyPluginSkeleton\Repositories\BookRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\Manager;

class RepositoryManager {
	public function __construct(
		private Manager $manager,
		BookRepository $book_repository
	) {
		$this->manager->register_repository( $book_repository );
	}
}

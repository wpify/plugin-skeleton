<?php

namespace WpifyPluginSkeleton\Models;

use WpifyPluginSkeleton\Repositories\BookRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\Attributes\Meta;
use WpifyPluginSkeletonDeps\Wpify\Model\Post;

/**
 * @method BookRepository model_repository()
 */
class BookModel extends Post {
	#[Meta]
	public ?string $isbn;

	#[Meta]
	public ?string $author_name;

	#[Meta]
	public ?int $rating;
}

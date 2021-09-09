<?php

namespace WpifyPluginSkeleton\Managers;

use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeleton\PostTypes\PagePostType;

final class PostTypesManager {
	public function __construct(
		BookPostType $book_post_type,
		PagePostType $page_post_type
	) {
	}
}

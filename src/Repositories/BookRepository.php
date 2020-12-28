<?php

namespace WpifyPlugin\Repositories;

use ComposePress\Core\Exception\Plugin;
use Wpify\Core_3_0\Abstracts\AbstractPostTypeRepository;
use WpifyPlugin\PostTypes\BookPostType;

/**
 * @property Plugin $plugin
 */
class BookRepository extends AbstractPostTypeRepository {

	public function post_type(): BookPostType {
		return $this->plugin->get_post_type( BookPostType::class );
	}
}

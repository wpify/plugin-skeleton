<?php

namespace WpifyPlugin\Repositories;

use WpifyPlugin\Plugin;
use WpifyPlugin\PostTypes\BookPostType;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractPostTypeRepository;

/**
 * @property Plugin $plugin
 */
class BookRepository extends AbstractPostTypeRepository {
	public function post_type(): BookPostType {
		return $this->plugin->get_post_type( BookPostType::class );
	}
}

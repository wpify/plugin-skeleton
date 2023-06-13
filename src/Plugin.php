<?php

namespace WpifyPluginSkeleton;

use WpifyPluginSkeleton\Managers\ApiManager;
use WpifyPluginSkeleton\Managers\BlocksManager;
use WpifyPluginSkeleton\Managers\PostTypesManager;
use WpifyPluginSkeleton\Managers\RepositoryManager;
use WpifyPluginSkeleton\Managers\SnippetsManager;

final class Plugin {
	public function __construct(
		RepositoryManager $repository_manager,
		ApiManager $api_manager,
		BlocksManager $blocks_manager,
		PostTypesManager $post_types_manager,
		SnippetsManager $snippets_manager,
		Frontend $frontend,
		Settings $settings
	) {
	}

	/**
	 * @param bool $network_wide
	 */
	public function activate( bool $network_wide ) {
	}

	/**
	 * @param bool $network_wide
	 */
	public function deactivate( bool $network_wide ) {
	}

	/**
	 *
	 */
	public function uninstall() {
	}
}

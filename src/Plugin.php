<?php

namespace WpifyMultilang;

use WpifyMultilang\Features\Post;
use WpifyMultilang\Managers\ApiManager;
use WpifyMultilang\Managers\RepositoryManager;

final class Plugin {
	public function __construct(
		RepositoryManager $repository_manager,
		ApiManager $api_manager,
		Settings $settings,
		private Post $post
	) {
		add_action('template_redirect', function() {
			if (isset($_GET['test'])) {
				$result = $this->post->translate_post(1,'post',2);
				dumpe($result);
			}
		});
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

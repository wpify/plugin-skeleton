<?php

namespace WpifyPlugin\Controllers;

use WpifyPlugin\Controller;
use WpifyPlugin\Plugin;
use WpifyPlugin\Repositories\BookRepository;
use WpifyPluginDeps\Doctrine\Common\Collections\ArrayCollection;

/**
 * @property Plugin $plugin
 */
class FrontPageController extends Controller {
	public function get_posts(): ArrayCollection {
		return $this->plugin->get_repository( BookRepository::class )->all();
	}
}

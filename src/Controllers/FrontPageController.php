<?php

namespace WpifyPlugin\Controllers;

use WpifyPlugin\Plugin;
use WpifyPlugin\Repositories\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use WpifyPlugin\Controller;

/**
 * @property Plugin $plugin
 */
class FrontPageController extends Controller {

	public function get_posts(): ArrayCollection {
		return $this->plugin->get_repository( BookRepository::class )->all();
	}
}

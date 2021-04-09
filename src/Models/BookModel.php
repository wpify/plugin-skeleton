<?php

namespace WpifyPlugin\Models;

use WpifyPlugin\Plugin;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractPostTypeModel;

/**
 * Class BookModel
 *
 * @property Plugin $plugin
 * @package WpifyPlugin\Models
 */
class BookModel extends AbstractPostTypeModel {
	private $author;
	private $isbn;

	/**
	 * @return void
	 */
	public function setup() {
		$this->author = $this->get_post_type()->get_field( $this->get_id(), 'author' );
		$this->isbn   = $this->get_post_type()->get_field( $this->get_id(), 'isbn' );
	}

	/**
	 * @return string
	 */
	public function get_author() {
		return $this->author;
	}

	/**
	 * @return string
	 */
	public function get_isbn() {
		return $this->isbn;
	}
}

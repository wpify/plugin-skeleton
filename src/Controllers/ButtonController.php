<?php

namespace WpifyPlugin\Controllers;

use WpifyPlugin\Controller;
use WpifyPlugin\Plugin;

/**
 * @property Plugin $plugin
 */
class ButtonController extends Controller {

	public function __construct() {
		$this->set_template( 'button' );
		$this->set_assets( array( 'button.css' ) );
	}
}

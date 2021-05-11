<?php

namespace WpifyPlugin;

use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractComponent;

/**
 * Class Settings
 *
 * @package Wpify\Settings
 * @property Plugin $plugin
 */
class Settings extends AbstractComponent {
	public $options = array();

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	private $key = 'wpify_plugin_options';

	public function setup() {
		$this->plugin->get_wcf()->add_options_page( array(
			'parent_slug' => 'options-general.php',
			'page_title'  => __( 'WPify Plugin Settings', 'wpify-plugin' ),
			'menu_title'  => __( 'WPify Plugin', 'wpify-plugin' ),
			'menu_slug'   => $this->key,
			'capability'  => 'manage_options',
			'items'       => array(
				array(
					'id'    => $this->key,
					'type'  => 'group',
					'items' => array(
						array(
							'title' => __( 'Some URL', 'wp-plugin' ),
							'id'    => 'some_url',
							'type'  => 'url',
						),
						array(
							'title' => __( 'Some HTML', 'wp-plugin' ),
							'id'    => 'some_html',
							'type'  => 'wysiwyg',
						),
					),
				),
			),
		) );
	}

	/**
	 * @param string $key
	 * @param null $default
	 *
	 * @return string|array
	 */
	public function get_option( $key = '', $default = null ) {
		if ( ! $this->options ) {
			$this->get_options();
		}

		if ( isset( $this->options[ $key ] ) ) {
			return $this->options[ $key ];
		}

		return $default ?: false;
	}

	/**
	 * Get all options
	 *
	 * @return array|mixed
	 */
	public function get_options() {
		if ( ! $this->options ) {
			$this->options = get_option( $this->key, array() );
		}

		return $this->options;
	}
}

<?php

namespace WpifyPluginSkeleton;

use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;

/**
 * Class Settings
 *
 * @package Wpify\Settings
 * @property Plugin $plugin
 */
class Settings {
	/**
	 * @var CustomFields
	 */
	public $wcf;

	/**
	 * @var array
	 */
	public $options = array();

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	private $key = 'wpify_plugin_skeleton_options';

	public function __construct( CustomFields $wcf ) {
		$this->wcf = $wcf;

		$this->setup();
	}

	public function setup() {
		$this->wcf->create_options_page( array(
			'parent_slug' => 'options-general.php',
			'page_title'  => __( 'WPify Plugin Skeleton Settings', 'wpify-plugin-skeleton' ),
			'menu_title'  => __( 'WPify Plugin Skeleton', 'wpify-plugin-skeleton' ),
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
						array(
							'title' => __( 'Multi attachments', 'wp-plugin' ),
							'id'    => 'some_attachments',
							'type'  => 'multi_attachment',
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

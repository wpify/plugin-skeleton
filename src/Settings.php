<?php

namespace WpifyMultilang;

use WpifyMultilangDeps\Wpify\CustomFields\CustomFields;

/**
 * Class Settings
 * @package Wpify\Settings
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
	 * @var string
	 */
	const KEY = 'wpify_multilang_options';

	public function __construct( CustomFields $wcf ) {
		$this->wcf = $wcf;
		add_action( 'init', [ $this, 'setup' ] );
	}

	public function setup() {
		$post_types = get_post_types();
		$taxonomies = get_taxonomies();

		$this->wcf->create_options_page(
			array(
				'parent_slug' => 'options-general.php',
				'page_title'  => __( 'Wpify Plugin Skeleton Settings', 'wpify-multilang' ),
				'menu_title'  => __( 'Wpify Plugin Skeleton', 'wpify-multilang' ),
				'menu_slug'   => self::KEY,
				'capability'  => 'manage_options',
				'items'       => array(
					array(
						'id'    => self::KEY,
						'type'  => 'group',
						'items' => array(
							array(
								'id'    => 'aaa',
								'type'  => 'text',
								'title' => 'dasdsa',
							),
							array(
								'title'   => __( 'Translatable Post Types', 'wp-plugin' ),
								'id'      => 'translatable_post_types',
								'type'    => 'multi_select',
								'options' => array_values( array_map( fn( $post_type ) => [
									'label' => $post_type,
									'value' => $post_type,
								],
									$post_types
								                           ) ),
							),
							array(
								'title'   => __( 'Translatable Taxonomies', 'wp-plugin' ),
								'id'      => 'translatable_taxonomies',
								'type'    => 'multi_select',
								'options' => array_values( array_map( fn( $taxonomy ) => [
									'label' => $taxonomy,
									'value' => $taxonomy,
								],
									$taxonomies
								                           ) ),
							),
						),
					),
				),
			) );
	}
}

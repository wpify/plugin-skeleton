<?php

namespace WpifyPluginSkeleton\Taxonomies;

use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeleton\PostTypes\PagePostType;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Taxonomy\AbstractCustomTaxonomy;

class LayoutTaxonomy extends AbstractCustomTaxonomy {
	const KEY = 'page_layout';

	/** @var CustomFields */
	protected $wcf;

	public function __construct( CustomFields $wcf ) {
		$this->wcf = $wcf;

		parent::__construct();
	}

	public function setup() {
		$this->wcf->create_taxonomy_options( array(
			'taxonomy' => $this->get_taxonomy_key(),
			'items'    => array(
				array(
					'type'  => 'text',
					'id'    => 'some_other_meta',
					'title' => __( 'Some other meta', 'wpify-plugin-skeleton' ),
				),
			),
		) );
	}

	/**
	 * @inheritDoc
	 */
	public function get_taxonomy_key(): string {
		return self::KEY;
	}

	/**
	 * @inheritDoc
	 */
	public function get_post_types(): array {
		return array( PagePostType::KEY, BookPostType::KEY );
	}

	public function get_args(): array {
		$singular = _x( 'Layout', 'post type singular name', 'wpify-plugin-skeleton' );
		$plural   = _x( 'Layouts', 'post type name', 'wpify-plugin-skeleton' );

		return array(
			'labels'            => $this->generate_labels( $singular, $plural ),
			'description'       => __( 'Layouts says how the page will be displayed', 'wpify-plugin-skeleton' ),
			'public'            => false,
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
		);
	}
}

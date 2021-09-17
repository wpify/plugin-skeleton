<?php

namespace WpifyPluginSkeleton\PostTypes;

use WpifyPluginSkeleton\Taxonomies\PublisherTaxonomy;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\PostType\AbstractCustomPostType;

class BookPostType extends AbstractCustomPostType {
	const KEY = 'book';

	/** @var CustomFields */
	protected $wcf;

	public function __construct( CustomFields $wcf ) {
		$this->wcf = $wcf;

		parent::__construct();
	}

	public function setup() {
		$this->wcf->create_metabox( array(
			'id'         => 'book-details',
			'title'      => __( 'Books details', 'wpify-plugin-skeleton' ),
			'post_types' => array( $this->get_post_type_key() ),
			'context'    => 'advanced',
			'priority'   => 'high',
			'items'      => array(
				array(
					'type'  => 'text',
					'id'    => 'isbn',
					'title' => __( 'ISBN', 'wpify-plugin-skeleton' ),
				),
				array(
					'type'  => 'text',
					'id'    => 'author_name',
					'title' => __( 'Author', 'wpify-plugin-skeleton' ),
				),
				array(
					'type'  => 'number',
					'id'    => 'rating',
					'title' => __( 'Rating', 'wpify-plugin-skeleton' ),
				),
			),
		) );
	}

	public function get_post_type_key(): string {
		return self::KEY;
	}

	public function get_args(): array {
		$singular = _x( 'Book', 'post type singular name', 'wpify-plugin-skeleton' );
		$plural   = _x( 'Books', 'post type name', 'wpify-plugin-skeleton' );

		return array(
			'label'              => $plural,
			'labels'             => $this->generate_labels( $singular, $plural ),
			'description'        => __( 'Custom post type Books created by WPify Plugin Skeleton', 'wpify-plugin-skeleton' ),
			'public'             => true,
			'hierarchical'       => false,
			'taxonomies'         => array( PublisherTaxonomy::KEY ),
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_admin_bar'  => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'supports'           => array(
				'title',
				'editor',
				'revisions',
				'excerpt',
				'thumbnail',
				'custom-fields'
			),
		);
	}
}

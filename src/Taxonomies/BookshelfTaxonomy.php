<?php

namespace WpifyPluginSkeleton\Taxonomies;

use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Taxonomy\AbstractCustomTaxonomy;

class BookshelfTaxonomy extends AbstractCustomTaxonomy {
	const KEY = 'bookshelf';

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
					'id'    => 'genre',
					'title' => __( 'Genre', 'wpify-plugin-skeleton' ),
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
		return array( BookPostType::KEY );
	}

	public function get_args(): array {
		$singular = _x( 'Bookshelf', 'post type singular name', 'wpify-plugin-skeleton' );
		$plural   = _x( 'Bookshelves', 'post type name', 'wpify-plugin-skeleton' );

		return array(
			'labels'            => $this->generate_labels( $singular, $plural ),
			'description'       => __( 'Bookshelf contains all the favorite books', 'wpify-plugin-skeleton' ),
			'public'            => true,
			'hierarchical'      => false,
			'show_in_rest'      => true,
			'show_admin_column' => true,
		);
	}
}

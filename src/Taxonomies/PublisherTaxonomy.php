<?php

namespace WpifyPluginSkeleton\Taxonomies;

use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Taxonomy\AbstractCustomTaxonomy;

class PublisherTaxonomy extends AbstractCustomTaxonomy {
	const KEY = 'publisher';

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
					'type'  => 'url',
					'id'    => 'url',
					'title' => __( 'URL', 'wpify-plugin-skeleton' ),
				),
				array(
					'type'  => 'attachment',
					'id'    => 'logo',
					'title' => __( 'Logo', 'wpify-plugin-skeleton' ),
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
		$singular = _x( 'Publisher', 'post type singular name', 'wpify-plugin-skeleton' );
		$plural   = _x( 'Publishers', 'post type name', 'wpify-plugin-skeleton' );

		return array(
			'labels'            => $this->generate_labels( $singular, $plural ),
			'description'       => __( 'Book publishers are responsible for overseeing the selection, production, marketing and distribution processes involved with new works of writing.', 'wpify-plugin-skeleton' ),
			'public'            => true,
			'hierarchical'      => false,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'show_tagcloud'     => false,
		);
	}
}

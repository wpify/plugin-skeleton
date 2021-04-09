<?php

namespace WpifyPlugin\PostTypes;

use WpifyPlugin\Models\BookModel;
use WpifyPlugin\Plugin;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractPostType;
use WpifyPluginDeps\WpifyCustomFields\Implementations\Metabox;

/**
 * Class BookPostType
 *
 * @package WpifyPlugin\Cpt
 * @property Plugin $plugin
 */
class BookPostType extends AbstractPostType {
	/** @var string */
	public const NAME = 'book';

	/** @var Metabox */
	private $metabox;

	public function setup() {
		$this->metabox = $this->plugin->get_wcf()->add_metabox( array(
			'id'         => 'book-details',
			'title'      => __( 'Book details', 'wpify-plugin' ),
			'post_types' => array( $this::NAME ),
			'items'      => array(
				array(
					'type'  => 'text',
					'id'    => 'author',
					'title' => __( 'Book author', 'wpify-plugin' ),
				),
				array(
					'type'  => 'text',
					'id'    => 'isbn',
					'title' => __( 'ISBN', 'wpify-plugin' ),
				),
			),
		) );
	}

	public function post_type_args(): array {
		$args = array(
			'labels'             => $this->get_generic_labels( 'Book', 'Books' ),
			'description'        => __( 'Description of books.', 'wpify-plugin' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'book' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		);

		return $args;
	}

	public function post_type_name(): string {
		return $this::NAME;
	}

	public function model(): string {
		return BookModel::class;
	}

	public function get_field( $id, $name ) {
		$this->metabox->set_post( $id );

		return $this->metabox->get_field( $name );
	}
}

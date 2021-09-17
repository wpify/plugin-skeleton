<?php

namespace WpifyPluginSkeleton\Blocks;

use WpifyPluginSkeleton\PostTypes\BookPostType;
use WpifyPluginSkeleton\Repositories\BookRepository;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Template\WordPressTemplate;

class BookBlock {
	private $wcf;
	private $template;
	private $book_repository;

	public function __construct( CustomFields $wcf, WordPressTemplate $template, BookRepository $book_repository ) {
		$this->wcf             = $wcf;
		$this->template        = $template;
		$this->book_repository = $book_repository;

		$this->setup();
	}

	public function setup() {
		$this->wcf->create_gutenberg_block( array(
			'name'            => 'wpify-plugin-skeleton/book',
			'title'           => __( 'Book', 'wpify-plugin-skeleton' ),
			'render_callback' => array( $this, 'render' ),
			'items'           => array(
				array(
					'type'      => 'post',
					'id'        => 'book',
					'title'     => __( 'Book', 'wpify-plugin-skeleton' ),
					'post_type' => BookPostType::KEY,
				),
				array(
					'type'  => 'text',
					'id'    => 'note',
					'title' => __( 'Note', 'wpify-plugin-skeleton' ),
				),
			),
		) );
	}

	public function render( array $block_attributes, string $content ) {
		$book = $this->book_repository->get( $block_attributes['book'] );
		$note = $block_attributes['note'] ?? null;

		return $this->template->render( 'blocks/book', null, array(
			'note' => $note,
			'book' => $book,
		) );
	}
}

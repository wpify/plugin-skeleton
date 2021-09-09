<?php

namespace WpifyPluginSkeleton\Blocks;

use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Template\WordPressTemplate;

class TestBlock {
	private $wcf;
	private $template;

	public function __construct( CustomFields $wcf, WordPressTemplate $template ) {
		$this->wcf      = $wcf;
		$this->template = $template;

		$this->setup();
	}

	public function setup() {
		$this->wcf->create_gutenberg_block( array(
			'name'            => 'wpify-plugin-skeleton/test-block',
			'title'           => __( 'Test block', 'wpify-plugin-skeleton' ),
			'render_callback' => array( $this, 'render' ),
			'items'           => array(
				array(
					'type'  => 'text',
					'id'    => 'title',
					'title' => __( 'Title', 'wpify-plugin-skeleton' ),
				),
				array(
					'type'  => 'textarea',
					'id'    => 'content',
					'title' => __( 'Content', 'wpify-plugin-skeleton' ),
				),
			),
		) );
	}

	public function render( array $block_attributes, string $content ) {
		return $this->template->render( 'blocks/test-block', null, array(
			'attributes' => $block_attributes,
			'content'    => $content,
		) );
	}
}

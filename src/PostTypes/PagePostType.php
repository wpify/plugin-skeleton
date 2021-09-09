<?php

namespace WpifyPluginSkeleton\PostTypes;

use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\PostType\AbstractBuiltinPostType;

class PagePostType extends AbstractBuiltinPostType {
	const KEY = 'page';

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
					'id'    => 'some_other_meta',
					'title' => __( 'Some other meta', 'wpify-plugin-skeleton' ),
				),
			),
		) );
	}

	public function get_post_type_key(): string {
		return self::KEY;
	}
}

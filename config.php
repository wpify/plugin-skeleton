<?php

use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\PluginUtils\PluginUtils;
use WpifyPluginSkeletonDeps\Wpify\Template\WordPressTemplate;
use function WpifyPluginSkeletonDeps\DI\create;

return array(
	CustomFields::class      => create()
		->constructor( plugins_url( 'vendor/wpify/custom-fields', __FILE__ ) ),
	WordPressTemplate::class => create()
		->constructor( array( __DIR__ . '/templates' ), 'wpify-plugin-skeleton' ),
	PluginUtils::class       => create()
		->constructor( __DIR__ . '/wpify-plugin-skeleton.php' ),
);

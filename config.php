<?php

use WpifyPluginSkeletonDeps\DI\Definition\Helper\CreateDefinitionHelper;
use WpifyPluginSkeletonDeps\Wpify\CustomFields\CustomFields;
use WpifyPluginSkeletonDeps\Wpify\Model\Manager;
use WpifyPluginSkeletonDeps\Wpify\PluginUtils\PluginUtils;
use WpifyPluginSkeletonDeps\Wpify\Template\WordPressTemplate;

return array(
	CustomFields::class      => ( new CreateDefinitionHelper() )
		->constructor( plugins_url( 'deps/wpify/custom-fields', __FILE__ ) ),
	WordPressTemplate::class => ( new CreateDefinitionHelper() )
		->constructor( array( __DIR__ . '/templates' ), 'wpify-plugin-skeleton' ),
	PluginUtils::class       => ( new CreateDefinitionHelper() )
		->constructor( __DIR__ . '/wpify-plugin-skeleton.php' ),
	Manager::class => ( new CreateDefinitionHelper() )
		->constructor( [] )
);

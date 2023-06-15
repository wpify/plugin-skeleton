<?php

use WpifyMultilangDeps\DI\Definition\Helper\CreateDefinitionHelper;
use WpifyMultilangDeps\Wpify\CustomFields\CustomFields;
use WpifyMultilangDeps\Wpify\Model\Manager;
use WpifyMultilangDeps\Wpify\PluginUtils\PluginUtils;
use WpifyMultilangDeps\Wpify\Template\WordPressTemplate;

return array(
	CustomFields::class      => ( new CreateDefinitionHelper() )
		->constructor( plugins_url( 'deps/wpify/custom-fields', __FILE__ ) ),
	WordPressTemplate::class => ( new CreateDefinitionHelper() )
		->constructor( array( __DIR__ . '/templates' ), 'wpify-multilang' ),
	PluginUtils::class       => ( new CreateDefinitionHelper() )
		->constructor( __DIR__ . '/wpify-multilang.php' ),
	Manager::class => ( new CreateDefinitionHelper() )
		->constructor( [] )
);

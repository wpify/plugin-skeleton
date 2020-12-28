<?php

use WpifyPlugin\Controllers\ButtonController;

get_header();
wpify_plugin_render(
	ButtonController::class,
	array(
		'label' => 'Some label',
		'link'  => 'https://wpify.io',
	)
);
wpify_plugin()->print_assets( 'some-module.css' );

while ( have_posts() ) {
	the_post();
	get_template_part( 'template-parts/content', get_post_type() );
}

get_footer();

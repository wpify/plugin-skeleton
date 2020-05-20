<?php

use Wpify\Controllers\ButtonController;

get_header();
/** @var ButtonController $controller */
wpify()->get_controller(ButtonController::class)->render(['label' => 'Some label','link' => 'https://wpify.io']);
wpify()->print_assets('some-module.css');

while (have_posts()) {
  the_post();
  get_template_part('template-parts/content', get_post_type());
}

get_footer();

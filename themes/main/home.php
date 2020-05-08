<?php

/** @var HomeController $controller */

use Wpify\Controllers\HomeController;

$controller = wpify()->get_controller(HomeController::class);

get_header();
$controller->print_styles($controller->get_assets());
while (have_posts()) {
  the_post();
  get_template_part('template-parts/content', get_post_type());
}

get_footer();

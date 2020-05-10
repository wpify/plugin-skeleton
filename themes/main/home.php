<?php

use Wpify\Controllers\HomeController;

get_header();
/** @var HomeController $controller */
$controller = wpify()->get_controller(HomeController::class);
$items      = $controller->get_posts();

wpify()->print_styles('home.css');

while (have_posts()) {
  the_post();
  get_template_part('template-parts/content', get_post_type());
}

get_footer();

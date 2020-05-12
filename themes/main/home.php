<?php

get_header();

wpify()->print_assets('some-module.css');

while (have_posts()) {
  the_post();
  get_template_part('template-parts/content', get_post_type());
}

get_footer();

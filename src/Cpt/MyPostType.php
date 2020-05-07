<?php

namespace Wpify\Cpt;

use Wpify\Core\PostType;
use Wpify\Models\MyPost;

class MyPostType extends PostType
{
  const NAME = 'my-post-type';

  public function post_type_args(): array
  {
    $args = [
      'labels'             => $this->get_generic_labels('My post', 'My posts'),
      'description'        => __('Description.', 'wpify'),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => ['slug' => 'book'],
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'],
    ];

    return $args;
  }

  public function post_type_name(): string
  {
    return $this::NAME;
  }

  public function model(): string
  {
    return MyPost::class;
  }
}

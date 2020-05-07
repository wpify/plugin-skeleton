<?php

namespace Wpify\Cpt;

use Wpify\Core\PostType;
use Wpify\Models\MyPost;

class MyPostType extends PostType
{
  const NAME = 'my-post-type';

  public function post_type_args(): array
  {
    $labels = [
      'name'               => _x('Books', 'post type general name', 'wpify'),
      'singular_name'      => _x('Book', 'post type singular name', 'wpify'),
      'menu_name'          => _x('Books', 'admin menu', 'wpify'),
      'name_admin_bar'     => _x('Book', 'add new on admin bar', 'wpify'),
      'add_new'            => _x('Add New', 'book', 'wpify'),
      'add_new_item'       => __('Add New Book', 'wpify'),
      'new_item'           => __('New Book', 'wpify'),
      'edit_item'          => __('Edit Book', 'wpify'),
      'view_item'          => __('View Book', 'wpify'),
      'all_items'          => __('All Books', 'wpify'),
      'search_items'       => __('Search Books', 'wpify'),
      'parent_item_colon'  => __('Parent Books:', 'wpify'),
      'not_found'          => __('No books found.', 'wpify'),
      'not_found_in_trash' => __('No books found in Trash.', 'wpify'),
    ];

    $args = [
      'labels'             => $labels,
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

  public function model() : string
  {
    return MyPost::class;
  }
}

<?php

namespace WpifyPlugin\Cpt;

use Wpify\Core_2_0\Abstracts\AbstractPostType;
use WpifyPlugin\Factories\Cmb2FieldsFactory;
use WpifyPlugin\Models\BookModel;
use WpifyPlugin\Plugin;

/**
 * Class BookPostType
 * @package WpifyPlugin\Cpt
 * @property Plugin $plugin
 */
class BookPostType extends AbstractPostType
{
  public const NAME = 'book';

  public function post_type_args(): array
  {
    $args = [
      'labels'             => $this->get_generic_labels('Book', 'Books'),
      'description'        => __('Description of books.', 'wpify-plugin'),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_rest'       => true,
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
    return BookModel::class;
  }

  public function custom_fields()
  {
    return [
      [
        'id'   => 'some_field',
        'name' => 'Some field',
        'desc' => '',
        'type' => 'text',
      ],
    ];
  }

  public function custom_fields_factory(): string
  {
    return Cmb2FieldsFactory::class;
  }
}

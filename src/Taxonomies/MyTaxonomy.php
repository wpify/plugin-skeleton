<?php

namespace Wpify\Taxonomies;

use Wpify\Core\Taxonomy;
use Wpify\Cpt\MyPostType;
use Wpify\Models\MyTaxonomyModel;

class MyTaxonomy extends Taxonomy
{
  public const NAME = 'my-taxonomy';

  public function taxonomy_args(): array
  {
    $args = [
      'labels'             => $this->get_generic_labels(
        __('My taxonomy', 'wpify'),
        __('My taxonomies', 'wpify')
      ),
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

  public function taxonomy_name(): string
  {
    return $this::NAME;
  }

  public function model(): string
  {
    return MyTaxonomyModel::class;
  }

  public function post_type(): string
  {
    return MyPostType::class;
  }
}

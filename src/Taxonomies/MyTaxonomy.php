<?php

namespace Wpify\Taxonomies;

use Wpify\Core\AbstractTaxonomy;
use Wpify\Cpt\MyPostType;
use Wpify\Models\MyTaxonomyModel;

class MyTaxonomy extends AbstractTaxonomy
{
  public const NAME = 'my-taxonomy';

  public function taxonomy_args(): array
  {
    $args = [
      'labels'             => $this->get_generic_labels(
        __('My taxonomy', 'wpify'),
        __('My taxonomies', 'wpify')
      ),
      'hierarchical'       => false,
      'public'             => true,
      'show_ui'            => true,
      'show_admin_columns' => true,
      'show_in_nav_menus'  => true,
      'show_tagcloud'      => true,
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

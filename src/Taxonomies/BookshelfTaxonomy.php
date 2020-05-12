<?php

namespace Wpify\Taxonomies;

use Wpify\Core\AbstractTaxonomy;
use Wpify\Cpt\BookPostType;
use Wpify\Models\BookshelfModel;

class BookshelfTaxonomy extends AbstractTaxonomy
{
  public const NAME = 'bookshelf';

  public function taxonomy_args(): array
  {
    $args = [
      'labels'             => $this->get_generic_labels(
        __('Bookshelf', 'wpify'),
        __('Bookshelves', 'wpify')
      ),
      'hierarchical'       => true,
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
    return BookshelfModel::class;
  }

  public function post_type(): string
  {
    return BookPostType::class;
  }
}

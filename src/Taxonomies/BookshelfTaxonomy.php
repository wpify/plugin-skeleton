<?php

namespace WpifyPlugin\Taxonomies;

use WpifyPlugin\Models\BookshelfModel;
use WpifyPlugin\Plugin;
use WpifyPlugin\PostTypes\BookPostType;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractTaxonomy;

/**
 * Class BookshelfTaxonomy
 *
 * @property Plugin $plugin
 * @package WpifyPlugin\Taxonomies
 */
class BookshelfTaxonomy extends AbstractTaxonomy {

  public const NAME = 'bookshelf';

  public function taxonomy_args(): array {
    $args = array(
      'labels'             => $this->get_generic_labels(
        __( 'Bookshelf', 'wpify-plugin' ),
        __( 'Bookshelves', 'wpify-plugin' )
      ),
      'hierarchical'       => true,
      'public'             => true,
      'show_ui'            => true,
      'show_in_rest'       => true,
      'show_admin_columns' => true,
      'show_in_nav_menus'  => true,
      'show_tagcloud'      => true,
    );

    return $args;
  }

  public function taxonomy_name(): string {
    return $this::NAME;
  }

  public function model(): string {
    return BookshelfModel::class;
  }

  public function post_type(): string {
    return BookPostType::class;
  }
}

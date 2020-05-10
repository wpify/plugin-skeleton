<?php

namespace Wpify\Core;

use WP_Taxonomy;
use Wpify\Core\PostType;

abstract class Taxonomy extends Component
{
  /** @var string */
  private $post_type;

  /** @var WP_Taxonomy */
  private $taxonomy;

  /** @var string */
  public $model;

  /** @var string */
  private $name;

  /** @var array */
  private $args = [];

  public function __construct()
  {
    $this->args      = $this->taxonomy_args();
    $this->name      = $this->taxonomy_name();
    $this->model     = $this->model();
    $this->post_type = $this->post_type();
  }

  public function setup()
  {
    add_action('init', [$this, 'register']);
  }

  /**
   * Registers the post type
   */
  public function register()
  {
    $post_type = $this->plugin->get_cpt($this->post_type);

    $this->taxonomy = register_taxonomy($this->name, $post_type->name, $this->args);

    register_taxonomy_for_object_type($this->name, $post_type->name);
  }

  /**
   * Gets post type object
   */
  public function get_taxonomy()
  {
    return $this->taxonomy;
  }

  public function get_model()
  {
    return $this->model;
  }

  public function set_model(string $model)
  {
    $this->model = $model;
  }

  /**
   * @return string
   */
  public function get_name(): string
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function set_name(string $name): void
  {
    $this->name = $name;
  }

  /**
   * @param array $args
   */
  public function get_args()
  {
    return $this->args;
  }

  /**
   * @param array $args
   */
  public function set_args(array $args): void
  {
    $this->args = $args;
  }

  /**
   * @param string $singular Singular name of the taxonomy
   * @param string $plural Plural name of the taxonomy
   */
  protected function get_generic_labels(string $singular, string $plural): array
  {
    $labels = array(
      'name'                       => sprintf(_x('%s', 'Taxonomy General Name', 'wpify'), $plural),
      'singular_name'              => sprintf(_x('%s', 'Taxonomy Singular Name', 'wpify'), $singular),
      'menu_name'                  => sprintf(__('%s', 'wpify'), $singular),
      'all_items'                  => sprintf(__('All %s', 'wpify'), $plural),
      'parent_item'                => sprintf(__('Parent %s', 'wpify'), $singular),
      'parent_item_colon'          => sprintf(__('Parent %s:', 'wpify'), $singular),
      'new_item_name'              => sprintf(__('New %s Name', 'wpify'), $singular),
      'add_new_item'               => sprintf(__('Add New %s', 'wpify'), $singular),
      'edit_item'                  => sprintf(__('Edit %s', 'wpify'), $singular),
      'update_item'                => sprintf(__('Update %s', 'wpify'), $singular),
      'view_item'                  => sprintf(__('View %s', 'wpify'), $singular),
      'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'wpify'), $plural),
      'add_or_remove_items'        => sprintf(__('Add or remove %s', 'wpify'), $plural),
      'choose_from_most_used'      => __('Choose from the most used', 'wpify'),
      'popular_items'              => sprintf(__('Popular %s', 'wpify'), $plural),
      'search_items'               => sprintf(__('Search %s', 'wpify'), $plural),
      'not_found'                  => __('Not Found', 'wpify'),
      'no_terms'                   => sprintf(__('No %s', 'wpify'), $plural),
      'items_list'                 => sprintf(__('%s list', 'wpify'), $plural),
      'items_list_navigation'      => sprintf(__('%s list navigation', 'wpify'), $plural),
    );

    return $labels;
  }

  abstract public function taxonomy_args(): array;

  abstract public function taxonomy_name(): string;

  abstract public function model(): string;

  abstract public function post_type(): string;
}

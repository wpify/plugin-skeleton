<?php

namespace Wpify\Core;

use WP_Post_Type;

abstract class PostType extends Component
{
  /** @var WP_Post_Type */
  private $post_type;

  /** @var string */
  public $model;

  /** @var string */
  private $name;

  /** @var array */
  private $args = [];

  public function __construct()
  {
    $this->args  = $this->post_type_args();
    $this->name  = $this->post_type_name();
    $this->model = $this->model();
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
    $this->post_type = register_post_type($this->name, $this->args);
  }

  /**
   * Gets post type object
   */
  public function get_post_type()
  {
    return $this->post_type;
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
   * @param string $singular Singular name of the post type
   * @param string $plural Plural name of the post type
   */
  protected function get_generic_labels(string $singular, string $plural): array
  {
    $labels = [
      'name'               => sprintf(_x('%s', 'post type general name', 'wpify'), $plural),
      'singular_name'      => sprintf(_x('%s', 'post type singular name', 'wpify'), $singular),
      'menu_name'          => sprintf(_x('%s', 'admin menu', 'wpify'), $plural),
      'name_admin_bar'     => sprintf(_x('%s', 'add new on admin bar', 'wpify'), $singular),
      'add_new'            => __('Add New', 'add new', 'wpify'),
      'add_new_item'       => sprintf(__('Add New %s', 'wpify'), $singular),
      'new_item'           => sprintf(__('New %s', 'wpify'), $singular),
      'edit_item'          => sprintf(__('Edit %s', 'wpify'), $singular),
      'view_item'          => sprintf(__('View %s', 'wpify'), $singular),
      'all_items'          => sprintf(__('All %s', 'wpify'), $plural),
      'search_items'       => sprintf(__('Search %s', 'wpify'), $plural),
      'parent_item_colon'  => sprintf(__('Parent %s:', 'wpify'), $plural),
      'not_found'          => sprintf(__('No %s found.', 'wpify'), $plural),
      'not_found_in_trash' => sprintf(__('No %s found in Trash.', 'wpify'), $plural),
    ];

    return $labels;
  }

  abstract public function post_type_args(): array;

  abstract public function post_type_name(): string;

  abstract public function model(): string;
}

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

  abstract public function post_type_args(): array;

  abstract public function post_type_name(): string;

  abstract public function model(): string;
}

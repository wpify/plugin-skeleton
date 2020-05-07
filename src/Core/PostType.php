<?php

namespace Wpify\Core;

class PostType extends Component
{
  /** @var WP_Post_Type */
  private $post_type;

  /** @var string */
  private $name;

  /** @var array */
  private $args = [];

  /**
   * @param string $name Post type identifier
   * @param array $args Arguments
   */
  public function __construct(string $name, array $args = [])
  {
    $this->name = $name;
    $this->args = $args;
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

  /**
   * Sets labels for the post type
   */
  public function set_labels(array $labels)
  {
    $this->args['labels'] = $labels;

    if ($this->post_type) {
      foreach ($this->args['labels'] as $label) {
        $this->post_type->labels->{$label} = $label;
      }
    }
  }

  public function get_labels()
  {
    return $this->args['labels'];
  }

  public function set_label(string $label)
  {
    $this->args['label'] = $label;

    if ($this->post_type) {
      $this->post_type->label = $label;
    }
  }

  public function get_label()
  {
    return $this->args['label'];
  }
}

<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use Wpify\Core\Interfaces\PostTypeModelInterface;

abstract class PostTypeModel extends Component implements PostTypeModelInterface
{
  /** @var \WP_Post */
  private $post;

  /**
   * @var \WP_Post_Type $post_type
   */
  private $post_type;

  /**
   * @return mixed
   */
  public function __construct($post, $post_type, $filter = null)
  {
    $this->post_type = $post_type;
    $this->post      = get_post($post, null, $filter);
  }

  public function get_post()
  {
    return $this->post;
  }

  /**
   * @return int|null
   */
  public function get_id()
  {
    return $this->post->ID ?? null;
  }

  public function get_custom_field($field)
  {
    $factory = $this->post_type->get_custom_fields_factory();
    if (!$factory) {
      throw new \Exception('You need to set custom fields factory to register and retrieve custom fields');
    }

    return $factory->get_field($this->get_id(), $field);
  }

  /**
   * @return mixed
   */
  public function get_post_type(): \WP_Post_Type
  {
    return $this->post_type;
  }

}

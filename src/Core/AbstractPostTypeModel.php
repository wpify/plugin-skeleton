<?php

namespace Wpify\Core;

use WP_Post_Type;
use Wpify\Core\AbstractComponent;
use Wpify\Core\Interfaces\CustomFieldsFactoryInterface;
use Wpify\Core\Interfaces\PostTypeModelInterface;

abstract class AbstractPostTypeModel extends AbstractComponent implements PostTypeModelInterface
{
  /** @var \WP_Post */
  private $post;

  /**
   * @var WP_Post_Type $post_type
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

  /**
   * Get custom field value
   *
   * @param $field
   *
   * @return mixed
   * @throws \Exception
   */
  public function get_custom_field($field)
  {
    $factory = $this->get_custom_fields_factory();
    if (!$factory) {
      throw new \Exception(__('You need to set custom fields factory to register and retrieve custom fields', 'wpify'));
    }

    return $factory->get_field($this->get_id(), $field);
  }

  /**
   * Get custom field value
   *
   * @param $field
   * @param $value
   *
   * @return mixed
   * @throws \Exception
   */
  public function save_custom_field($field, $value)
  {
    $factory = $this->get_custom_fields_factory();
    if (!$factory) {
      throw new \Exception(__('You need to set custom fields factory to register and save custom fields', 'wpify'));
    }

    return $factory->save_field($this->get_id(), $field, $value);
  }

  /**
   * @return CustomFieldsFactoryInterface|false
   */
  private function get_custom_fields_factory()
  {
    return $this->post_type->get_custom_fields_factory();
  }

  /**
   * Get Post type for the current model
   * @return WP_Post_Type
   */
  public function get_post_type(): WP_Post_Type
  {
    return $this->post_type;
  }
}

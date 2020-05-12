<?php

namespace Wpify\Core;

use WP_Post_Type;
use Wpify\Core\Interfaces\CustomFieldsFactoryInterface;

abstract class AbstractCustomFieldsFactory extends AbstractComponent implements CustomFieldsFactoryInterface
{
  /**
   * @var WP_Post_Type $post_type
   */
  private $post_type;

  /**
   * @var [] $custom_fields
   */
  private $custom_fields;

  /**
   * @return WP_Post_Type
   */
  public function get_post_type()
  {
    return $this->post_type;
  }

  /**
   * @param mixed $post_type
   */
  public function set_post_type($post_type): void
  {
    $this->post_type = $post_type;
  }

  /**
   * @return mixed
   */
  public function get_custom_fields()
  {
    return $this->custom_fields;
  }

  /**
   * @param mixed $custom_fields
   */
  public function set_custom_fields($custom_fields): void
  {
    $this->custom_fields = $custom_fields;
  }
}

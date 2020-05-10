<?php

namespace Wpify\Core\Interfaces;

interface CustomFieldsFactoryInterface
{
  /**
   * CustomFieldsFactoryInterface constructor.
   *
   * @param \WP_Post_Type $post_type
   * @param $fields
   */
  public function __construct(\WP_Post_Type $post_type, $fields);

  /**
   * Get custom field value
   *
   * @param $id
   * @param $field
   *
   * @return mixed
   */
  public function get_field($id, $field);

  /**
   * Save custom field value
   *
   * @param $id
   * @param $field
   * @param $value
   *
   * @return mixed
   */
  public function save_field($id, $field, $value);
}

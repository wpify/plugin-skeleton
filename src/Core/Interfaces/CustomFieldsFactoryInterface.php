<?php

namespace Wpify\Core\Interfaces;

interface CustomFieldsFactoryInterface
{
  public function __construct(\WP_Post_Type $post_type, $fields);

  public function get_field($id, $field);
}

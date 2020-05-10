<?php

namespace Wpify;

class CustomFieldsFactory extends \Wpify\Core\CustomFieldsFactory
{
  public function __construct(\WP_Post_Type $post_type, $fields)
  {
    $this->set_post_type($post_type);
    $this->set_custom_fields($fields);
  }

  public function setup()
  {
    add_action('cmb2_admin_init', [$this, 'register_metaboxes']);
  }

  public function get_field($id, $field)
  {
    return get_post_meta($id, $field, true);
  }

  public function register_metaboxes()
  {
    $cmb = new_cmb2_box(
      [
        'id'           => $this->get_post_type()->name . 'metabox',
        'title'        => sprintf(__('%s Metabox', 'wpify'), $this->get_post_type()->label),
        'object_types' => array($this->get_post_type()->name),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true,
      ]
    );

    foreach ($this->get_custom_fields() as $field) {
      $cmb->add_field($field);
    }
  }
}

<?php

namespace WpifyPlugin\Factories;

use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractCustomFieldsFactory;

class Cmb2FieldsFactory extends AbstractCustomFieldsFactory {

  /**
   * Register hooks
   *
   * @return bool|void
   */
  public function setup() {
    add_action( 'cmb2_admin_init', array( $this, 'register_metaboxes' ) );
  }

  /**
   * Get a single field value
   *
   * @param $id
   * @param $field
   *
   * @return mixed
   */
  public function get_field( $id, $field ) {
    return get_post_meta( $id, $field, true );
  }

  /**
   * Save custom field value
   *
   * @param $id
   * @param $field
   * @param $value
   *
   * @return bool|int
   */
  public function save_field( $id, $field, $value ) {
    return update_post_meta( $id, $field, $value );
  }


  /**
   * Register metaboxes
   */
  public function register_metaboxes() {
    $cmb = new_cmb2_box(
      array(
        'id'           => $this->get_entity_name() . '_metabox',
        'title'        => __( 'Details', 'skialpuj' ),
        'object_types' => array( $this->get_entity_name() ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true,
      )
    );

    foreach ( $this->get_custom_fields() as $field ) {
      $cmb->add_field( $field );
    }
  }
}

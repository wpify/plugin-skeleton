<?php

namespace WpifyPlugin\Factories;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Wpify\Core\AbstractCustomFieldsFactory;

class CarbonFieldsFactory extends AbstractCustomFieldsFactory
{
  private $container = null;

  /**
   * Register hooks
   * @return bool|void
   */
  public function setup()
  {
    add_action('carbon_fields_register_fields', [$this, 'register_metaboxes']);
  }

  /**
   * Get a single field value
   *
   * @param $id
   * @param $field
   * @return mixed
   */
  public function get_field($id, $field)
  {
    return carbon_get_post_meta($id, $field, true);
  }

  /**
   * Save custom field value
   * @param int $id
   * @param string $field
   * @param mixed $value
   * @return bool|int
   */
  public function save_field($id, $field, $value)
  {
    carbon_set_post_meta($id, $field, $value, $this->container ? $this->container->get_id() : null);
    return true;
  }

  /**
   * Register metaboxes
   * @param string|null $title
   */
  public function register_metaboxes()
  {
    $title = __('Custom fields', 'skiapluj');

    $this->container = Container::make('post_meta', $title)
      ->where('post_type', '=', $this->get_entity_name())
      ->add_fields(array_map(
        fn($f) => Field::make($f['type'], $f['id'], $f['name']),
        $this->get_custom_fields()
      ));
  }
}

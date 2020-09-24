<?php

namespace WpifyPlugin\Factories;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Wpify\Core_2_0\Abstracts\AbstractCustomFieldsFactory;

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
   *
   * @return mixed
   */
  public function get_field($id, $field)
  {
    if ($this->get_type() === 'cpt') {
      return carbon_get_post_meta($id, $field, $this->container ? $this->container->get_id() : null);
    } elseif ($this->get_type() === 'taxonomy') {
      return carbon_get_term_meta($id, $field, $this->container ? $this->container->get_id() : null);
    }
  }

  /**
   * Save custom field value
   *
   * @param int $id
   * @param string $field
   * @param mixed $value
   *
   * @return bool|int
   */
  public function save_field($id, $field, $value)
  {
    if ($this->get_type() === 'cpt') {
      carbon_set_post_meta($id, $field, $value, $this->container ? $this->container->get_id() : null);
    } elseif ($this->get_type() === 'taxonomy') {
      carbon_set_term_meta($id, $field, $value, $this->container ? $this->container->get_id() : null);
    }

    return true;
  }

  /**
   * Register metaboxes
   *
   * @param string|null $title
   */
  public function register_metaboxes()
  {
    $title = __('Custom fields', 'skiapluj');

    if ($this->get_type() === 'cpt') {
      $this->container = Container::make('post_meta', $title)->where('post_type', '=', $this->get_entity_name());
    } elseif ($this->get_type() === 'taxonomy') {
      $this->container = Container::make('term_meta', $title)->where('term_taxonomy', '=', $this->get_entity_name());
    }

    $this->container->add_fields(
      array_map(
        function ($f) {
          $field = Field::make($f['type'], $f['id'], $f['name']);

          if (isset($f['config']) && is_callable($f['config'])) {
            $f['config']($field);
          }

          return $field;
        },
        $this->get_custom_fields()
      )
    );
  }
}

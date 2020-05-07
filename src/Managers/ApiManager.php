<?php

namespace Wpify\Managers;

use Wpify\Api\ExampleApi;
use Wpify\Core\Manager;

class ApiManager extends Manager
{
  const REST_NAMESPACE = 'wpify/v1';
  const NONCE_ACTION = 'wp_rest';

  protected $modules = [
    ExampleApi::class,
  ];

  public function get_rest_url()
  {
    return rest_url($this->get_rest_namespace());
  }

  public function get_rest_namespace()
  {
    return $this::REST_NAMESPACE;
  }

  public function get_nonce_action()
  {
    return $this::NONCE_ACTION;
  }

  public function setup()
  {
    add_filter('woocommerce_is_rest_api_request', [$this, 'simulate_as_not_request']);
  }

  /**
   * We have to tell WC that this should not be handled as a REST request.
   * Otherwise we can't use the product loop template contents properly.
   * Since WooCommerce 3.6
   *
   * @param bool $is_rest_api_request
   *
   * @return bool
   */
  public function simulate_as_not_request($is_rest_api_request)
  {
    if (empty($_SERVER['REQUEST_URI'])) {
      return $is_rest_api_request;
    }

    // Bail early if this is not our request.
    if (false === strpos($_SERVER['REQUEST_URI'], $this->get_rest_namespace())) {
      return $is_rest_api_request;
    }

    return false;
  }
}

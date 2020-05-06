<?php

namespace Wpify\Managers;

use Wpify\Core\Manager;

class ApiManager extends Manager
{

  const MODULE_NAMESPACE = '\Wpify\Api';
  const REST_NAMESPACE = 'wpify/v1';

  protected $modules = [
    'ExampleApi',
  ];

  public function getRestUrl()
  {
    return rest_url($this->getRestNamespace());
  }

  public function getRestNamespace()
  {
    return $this::REST_NAMESPACE;
  }

  public function setup()
  {
    add_filter('woocommerce_is_rest_api_request', [$this, 'simulateAsNotRequest']);
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
  public function simulateAsNotRequest($is_rest_api_request)
  {
    if (empty($_SERVER['REQUEST_URI'])) {
      return $is_rest_api_request;
    }

    // Bail early if this is not our request.
    if (false === strpos($_SERVER['REQUEST_URI'], $this->getRestNamespace())) {
      return $is_rest_api_request;
    }

    return false;
  }
}

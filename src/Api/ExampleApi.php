<?php

namespace WpifyPlugin\Api;

use Wpify\Core\Abstracts\AbstractRest;
use WP_REST_Server;
use WP_REST_Response;
use WpifyPlugin\Plugin;

/**
 * @property Plugin $plugin
 */
class ExampleApi extends AbstractRest
{
  /**
   * ExampleApi constructor.
   */
  public function __construct()
  {
  }

  public function setup()
  {
    add_action('rest_api_init', [$this, 'register_routes']);
  }

  /**
   * Register the routes for the objects of the controller.
   */
  public function register_routes()
  {
    register_rest_route(
      $this->plugin->get_api_manager()->get_rest_namespace(),
      'some-endpoint',
      [
        [
          'methods'  => WP_REST_Server::CREATABLE,
          'callback' => [$this, 'handle_some_endpoint'],
          'args'     => [
            'size' => [
              'required' => true,
            ],
          ],
        ],
      ]
    );

    register_rest_route(
      $this->plugin->get_api_manager()->get_rest_namespace(),
      '/set-app-name',
      [
        'methods' => WP_REST_Server::EDITABLE,
        'callback' => [$this, 'set_app_name'],
        'args' => [
          'nonce' => [
            'required' => true,
            'validate_callback' => function ($nonce) {
              return wp_verify_nonce($nonce, $this->plugin->get_api_manager()->get_nonce_action());
            },
          ],
          'name' => [
            'required' => true,
          ],
        ],
      ]
    );
  }

  /**
   * Add box to cart
   *
   * @param \WP_REST_Request $request Full data about the request.
   *
   * @return \WP_Error|\WP_REST_Request|\WP_REST_Response | bool
   * @throws \ComposePress\Core\Exception\Plugin
   */
  public function handle_some_endpoint($request)
  {
    $size = $request->get_param('size');

    return new WP_REST_Response(['size' => $size], 201);
  }

  public function set_app_name($request)
  {
    $params = $request->get_params();

    set_transient('wpify_app_name', $params['name']);

    return rest_ensure_response($params);
  }


  /**
   * Check if a given request has access to create items
   *
   * @param \WP_REST_Request $request Full data about the request.
   *
   * @return \WP_Error|bool
   */
  public function create_item_permissions_check($request)
  {
    return true;
  }


  /**
   * Prepare the item for the REST response
   *
   * @param mixed            $item WordPress representation of the item.
   * @param \WP_REST_Request $request Request object.
   *
   * @return mixed
   */
  public function prepare_item_for_response($item, $request)
  {
    return [];
  }
}

<?php

namespace Wpify\Api;

use Wpify\Core\Rest;
use WP_REST_Server;
use WP_REST_Response;

/**
 * Class Rest
 * @package WPProgramator\sonoma
 */
class ExampleApi extends Rest
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

    return new WP_REST_Response([ 'size' => $size ], 201);
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
   * @param mixed $item WordPress representation of the item.
   * @param \WP_REST_Request $request Request object.
   *
   * @return mixed
   */
  public function prepare_item_for_response($item, $request)
  {
    return [];
  }
}

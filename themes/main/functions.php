<?php

/**
 * Render a controller view
 * @param $controller
 * @param array $data
 * @param string $view
 * @param bool $return
 */
function wpify_render($controller, $data = [], $view = '', $return = false)
{
  wpify()->get_controller($controller)->render($data, $view, $return);
}

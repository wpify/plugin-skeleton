<?php

namespace Wpify;

use Wpify\Core\Component;

class Assets extends Component
{
  /** @var $assets [] */
  private $assets;

  /** @var $assets [] */
  private $assets_manifest;


  /** @var $enqueued_assets [] */
  private $enqueued_assets = [];

  /** @var $printed_assets [] */
  private $printed_assets = [];


  public function setup()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('wp_head', [$this, 'preload_styles']);
  }

  public function enqueue_assets()
  {
    $preloading_styles_enabled = $this->preloading_styles_enabled();

    foreach ($this->assets as $asset) {
      if ($this->is_asset_enqueued($asset['handle'])) {
        continue;
      }

      if ($asset['type'] === 'script') {
        wp_enqueue_script(
          $asset['handle'],
          $asset['file'],
          $asset['deps'],
          $asset['version'],
          $asset['in_footer']
        );

        if ($asset['localize']) {
          foreach ($asset['localize'] as $object_name => $args) {
            wp_localize_script($asset['handle'], $object_name, $args);
          }
        }
      } elseif ($asset['type'] === 'style') {
        if (!$preloading_styles_enabled || !isset($data['preload'])) {
          wp_enqueue_style($asset['handle'], $asset['file'], $asset['deps']);
        } else {
          wp_register_style($asset['handle'], $asset['file'], $asset['deps']);
          wp_style_add_data($asset['handle'], 'precache', true);
        }
      }
      $this->enqueued_assets[] = $asset['handle'];
    }
  }

  /**
   * Add a single asset
   * @param array $asset
   *
   * @throws \ComposePress\Core\Exception\Plugin
   */
  public function add_asset(array $asset)
  {
    if (!$asset['handle']) {
      throw new \ComposePress\Core\Exception\Plugin("Asset args have to contain 'handle'.");
    }
    if (!$asset['file']) {
      $asset['file'] = $this->asset($asset['handle']);
    }

    $asset['type'] = $this->get_file_type($asset['file']);

    if (!$asset['type']) {
      throw new \ComposePress\Core\Exception\Plugin("Failed to get file type.");
    }


    $this->assets[] = wp_parse_args($asset, $this->get_default_args());
  }

  public function add_assets(array $assets)
  {
    foreach ($assets as $asset) {
      $this->add_asset($asset);
    }
  }

  public function get_file_type($filename)
  {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    switch ($extension) {
      case 'js':
      case 'jsx':
        $file_type = 'script';
        break;
      case 'css':
      case 'jsx':
        $file_type = 'style';
        break;
      default:
        $file_type = false;
    }

    return $file_type;
  }

  public function get_default_args()
  {
    return [
      'handle'    => '',
      'file'      => '',
      'in_footer' => true,
      'version'   => true,
      'deps'      => [],
      'preload'   => false,
      'localize'  => false,
      'type'      => '',
    ];
  }

  public function is_asset_enqueued($handle)
  {
    return in_array($handle, $this->enqueued_assets);
  }

  /**
   * Preloads in-body stylesheets depending on what templates are being used.
   * Only stylesheets that have a 'preload_callback' provided will be considered. If that callback evaluates to true
   * for the current request, the stylesheet will be preloaded.
   * Preloading is disabled when AMP is active, as AMP injects the stylesheets inline.
   * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
   */
  public function preload_styles()
  {
    // If preloading styles is disabled, return early.
    if (!$this->preloading_styles_enabled()) {
      return;
    }

    foreach ($this->get_styles() as $asset) {
      // Skip if no preload callback provided.
      if (!$asset['preload']) {
        continue;
      }


      $handle = $asset['handle'];

      $wp_styles   = wp_styles();
      $preload_uri = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;

      echo '<link rel="preload" id="' . esc_attr($handle) . '-preload" href="' . esc_url(
          $preload_uri
        ) . '" as="style">';
      echo "\n";
    }
  }


  /**
   * Prints stylesheet link tags directly.
   * This should be used for stylesheets that aren't global and thus should only be loaded if the HTML markup
   * they are responsible for is actually present. Template parts should use this method when the related markup
   * requires a specific stylesheet to be loaded. If preloading stylesheets is disabled, this method will not do
   * anything.
   * If the `<link>` tag for a given stylesheet has already been printed, it will be skipped.
   *
   * @param string ...$handles One or more stylesheet handles.
   */
  public function print_styles(string ...$handles)
  {
    // If preloading styles is disabled (and thus they have already been enqueued), return early.
    if (!$this->preloading_styles_enabled()) {
      return;
    }

    if (empty($handles)) {
      return;
    }

    if (is_array($handles)) {
      $handles = array_filter(
        $handles,
        function ($handle) {
          return !in_array($handle, $this->printed_assets);
        }
      );
    } else {
      if (in_array($handles, $this->printed_assets)) {
        return;
      }
    }

    if (is_array($handles)) {
      foreach ($handles as $handle) {
        $this->printed_assets[] = $handle;
      }
    } else {
      $this->printed_assets[] = $handles;
    }

    wp_print_styles($handles);
  }

  /**
   * Determines whether to preload stylesheets and inject their link tags directly within the page content.
   * Using this technique generally improves performance, however may not be preferred under certain circumstances.
   * For example, since AMP will include all style rules directly in the head, it must not be used in that context.
   * By default, this method returns true unless the page is being served in AMP. The
   * {@see 'wp_rig_preloading_styles_enabled'} filter can be used to tweak the return value.
   * @return bool True if preloading stylesheets and injecting them is enabled, false otherwise.
   */
  protected function preloading_styles_enabled()
  {
    /**
     * Filters whether to preload stylesheets and inject their link tags within the page content.
     *
     * @param bool $preloading_styles_enabled Whether preloading stylesheets and injecting them is enabled.
     */
    return apply_filters($this->plugin->safe_slug . '_preloading_styles_enabled', true);
  }

  private function get_styles()
  {
    return array_filter(
      $this->assets,
      function ($asset) {
        return $this->get_file_type($asset['file']) === 'style';
      }
    );
  }

  /**
   * Gets asset URL from assets-manifest.json
   *
   * @param $file
   *
   * @return string
   * @throws \Exception
   */
  public function asset($file): string
  {
    $manifest = $this->plugin->get_asset_path('build/assets-manifest.json');

    if (!$this->assets_manifest && file_exists($manifest)) {
      $this->assets_manifest = json_decode(file_get_contents($manifest), true);
    }

    if (isset($this->assets_manifest[$file])) {
      return $this->plugin->get_asset_url("build/{$this->assets_manifest[$file]}");
    }

    return '';
  }

  /**
   * @return mixed
   */
  public function get_printed_assets()
  {
    return $this->printed_assets;
  }
}

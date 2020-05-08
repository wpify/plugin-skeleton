<?php

namespace Wpify\Core;

abstract class Assets extends Component
{
  /** @var $assets [] */
  private $assets;

  /** @var $assets [] */
  private $assets_manifest;


  /** @var $enqueued_assets [] */
  private $enqueued_assets;

  public function setup()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('wp_head', [$this, 'preload_styles']);
  }

  public function enqueue_assets()
  {
    $preloading_styles_enabled = $this->preloading_styles_enabled();

    foreach ($this->assets as $handle => $asset) {
      if ($this->is_asset_enqueued($handle)) {
        continue;
      }

      $type = $this->get_file_type($this->asset($handle));
      if (!$type) {
        continue;
      }

      if ($type === 'script') {
        wp_enqueue_script(
          $handle,
          $this->asset($handle),
          $asset['deps'],
          false,
          empty($asset['in_footer']) ? true : $asset['in_footer']
        );
      } elseif ($type === 'style') {
        if (!$preloading_styles_enabled || !isset($data['preload'])) {
          wp_enqueue_style($handle, $this->asset($handle), $asset['deps']);
        } else {
          wp_register_style($handle, $this->asset($handle), $asset['deps']);
          wp_style_add_data($handle, 'precache', true);
        }
      }
    }
  }


  public function add_asset(array $asset)
  {
    $this->assets[] = $asset;
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

    foreach ($this->assets as $handle => $asset) {
      // Skip if no preload callback provided.
//      if (!is_callable($asset['preload_callback'])) {
//        continue;
//      }

      // Skip if preloading is not necessary for this request.
//      if (!call_user_func($data['preload_callback'])) {
//        continue;
//      }

      if (!$this->get_file_type($this->asset($handle) !== 'style')) {
        continue;
      }

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
  public
  function print_style(
    string ...$handles
  ) {
    // If preloading styles is disabled (and thus they have already been enqueued), return early.
    if (!$this->preloading_styles_enabled()) {
      return;
    }

    $css_files = $this->get_css_files();
    $handles   = array_filter(
      $handles,
      function ($handle) use ($css_files) {
        $is_valid = isset($css_files[$handle]) && !$css_files[$handle]['global'];
        if (!$is_valid) {
          /* translators: %s: stylesheet handle */
          _doing_it_wrong(
            __CLASS__ . '::print_styles()',
            esc_html(sprintf(__('Invalid theme stylesheet handle: %s', 'wp-rig'), $handle)),
            'WP Rig 2.0.0'
          );
        }

        return $is_valid;
      }
    );

    if (empty($handles)) {
      return;
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
    return apply_filters('wpify_preloading_styles_enabled', true);
  }

  private function get_styles()
  {
    return array_filter(
      $this->assets,
      function ($handle) {
        return $this->get_file_type($handle) === 'style';
      },
      ARRAY_FILTER_USE_KEY
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
      return $this->plugin->get_asset_path("build/{$this->assets_manifest[$file]}");
    }

    return null;
  }
}

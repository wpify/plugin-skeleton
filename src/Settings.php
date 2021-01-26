<?php

namespace WpifyPlugin;

use Wpify\Core_4_0\Abstracts\AbstractComponent;
use WpifyPlugin\Managers\RepositoriesManager;

/**
 * Class Settings
 *
 * @package Wpify\Settings
 */
class Settings extends AbstractComponent {

	public $options = array();

	/**
	 * Options Page title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 *
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	private $key = 'wpify_options';

	/**
	 * Options page metabox id
	 *
	 * @var string
	 */
	private $metabox_id = 'wpify_options_metabox';

	/**
	 * @var RepositoriesManager
	 */
	private $repositories_manager;

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 */
	public function __construct( RepositoriesManager $repositories_manager ) {
		// Set our title
		$this->title = __( 'WPify', 'wpify-plugin' );
		$this->hooks();
		$this->repositories_manager = $repositories_manager;
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 *
	 * @since 0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 *
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_submenu_page(
		  'options-general.php',
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);
		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 *
	 * @since 0.1.0
	 */
	public function admin_page_display() {
		?>
	<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
	  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
	</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 *
	 * @since 0.1.0
	 */
	public function add_options_page_metabox() {
		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box(
			array(
				'id'         => $this->metabox_id,
				'hookup'     => false,
				'cmb_styles' => true,
				'show_on'    => array(
					// These are important, don't remove
					'key'   => 'options-page',
					'value' => array( $this->key ),
				),
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Some Field', 'wpify-plugin' ),
				'id'   => 'box_product_id',
				'type' => 'text',
			)
		);
	}

	/**
	 * Register settings notices for display
	 *
	 * @param int   $object_id Option key
	 * @param array $updated   Array of updated fields
	 *
	 * @return void
	 * @since  0.1.0
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'rm' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 *
	 * @param string $field Field to retrieve
	 *
	 * @return mixed Field value or exception is thrown
	 * @throws \Exception
	 * @since  0.1.0
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( ! in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page', 'plugin' ), true ) ) {
			throw new \Exception( 'Invalid property: ' . $field );
		}

		return $this->{$field};
	}

	/**
	 * @param string $key
	 * @param null   $default
	 *
	 * @return string|array
	 */
	public function get_option( $key = '', $default = null ) {
		if ( ! $this->options ) {
			$this->get_options();
		}

		if ( isset( $this->options[ $key ] ) ) {
			return $this->options[ $key ];
		}

		return $default ?: false;
	}

	/**
	 * Get all options
	 *
	 * @return array|mixed
	 */
	public function get_options() {
		if ( ! $this->options ) {
			if ( function_exists( 'cmb2_get_option' ) ) {
				// Use cmb2_get_option as it passes through some key filters.
				$this->options = cmb2_get_option( $this->key, 'all' );
			}
			// Fallback to get_option if CMB2 is not loaded yet.
			$this->options = get_option( $this->key, array() );
		}

		return $this->options;
	}
}

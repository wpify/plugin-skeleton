<?php

namespace WpifyMultilang\Features;

use WpifyMultilang\Repositories\SettingsRepository;

class Settings {
	public function __construct(
		private SettingsRepository $settings_repository
	) {
	}

	public function get_translatable_post_types() {
		return $this->settings_repository->get_option( 'translatable_post_types' ) ?: [];
	}

	public function is_post_type_translatable( string $post_type ): bool {
		return in_array( $post_type, $this->get_translatable_post_types() );
	}

	public function get_translatable_taxonomies() {
		return $this->settings_repository->get_option( 'translatable_taxonomies' ) ?: [];
	}

	public function is_taxonomy_translatable( string $taxonomy ): bool {
		return in_array( $taxonomy, $this->get_translatable_taxonomies() );
	}
}

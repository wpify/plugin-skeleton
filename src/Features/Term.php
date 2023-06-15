<?php

namespace WpifyMultilang\Features;

use Exception;
use WP_Error;
use WP_Term;
use WpifyMultilang\Managers\RepositoryManager;
use WpifyMultilang\Repositories\TranslationRepository;

class Term {
	const OBJECT_TYPE = 'term';

	public function __construct(
		private TranslationRepository $translation_repository,
		private RepositoryManager $repository_manager,
		private Relations $relations
	) {
	}

	/**
	 * Translate term.
	 *
	 * @param  int  $term_id  Post ID.
	 * @param  string  $taxonomy  Taxonomy.
	 * @param  array  $translate_side_ids  Translate site IDs.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function translate_term( int $term_id, string $taxonomy, int $target_site_id ): void {
		$this->create_remote_term( $term_id, $taxonomy, $target_site_id );
	}

	/**
	 * Create remote term if doesn't exist.
	 *
	 * @param  int  $term_id  Term ID.
	 * @param  string  $taxonomy  Taxonomy.
	 * @param  int  $target_site_id  Target site ID.
	 *
	 * @return int
	 * @throws Exception
	 */
	private function create_remote_term( int $term_id, string $taxonomy, int $target_site_id ): int {
		$translation = $this->translation_repository->get_linked_translation( $term_id, $target_site_id, self::OBJECT_TYPE );

		if ( is_null( $translation ) ) {
			$repo = $this->repository_manager->get_repository_by_taxonomy( $taxonomy );
			if ( ! $repo ) {
				throw new Exception( 'Taxonomy is not translatable' );
			}
			$term = $repo->get($term_id);
			switch_to_blog( $target_site_id );
			$new_term = $this->insert_remote_term( $taxonomy, $taxonomy, $term );
			restore_current_blog();
			if ( is_wp_error( $new_term ) ) {
				if ( isset( $new_term->error_data['term_exists'] ) ) {
					$exists_term_id = $new_term->error_data['term_exists'];
					$this->relations->link_objects( $term_id, $target_site_id, $exists_term_id, self::OBJECT_TYPE );

					return $exists_term_id;
				} else {
					throw new Exception( sprintf( 'Term %s in taxonomy %s (Site ID: %d) - error %s', $term->name, $taxonomy, $target_site_id, $new_term->get_error_message() ) );
				}
			}

			$this->relations->link_objects( $term_id, $target_site_id, $new_term['term_id'], self::OBJECT_TYPE );

			return $new_term['term_id'];
		} else {
			return $translation->target_object_id;
		}
	}

	/**
	 * Insert remote term.
	 *
	 * @param  string  $original_taxonomy  Original taxonomy.
	 * @param  string  $remote_taxonomy  Remote taxonomy.
	 * @param  WP_Term  $term  Original term..
	 *
	 * @return array|WP_Error
	 */
	public function insert_remote_term( string $original_taxonomy, string $remote_taxonomy, \WpifyMultilangDeps\Wpify\Model\Term $term ): array|WP_Error {
		global $wp_taxonomies;
		$temp_taxonomies = $wp_taxonomies;
		$wp_taxonomies[ $remote_taxonomy ] = $wp_taxonomies[ $original_taxonomy ];

		$new_term = wp_insert_term(
			$term->name,
			$remote_taxonomy,
			array(
				'description' => $term->description,
				'slug'        => $term->slug,
				'parent'      => $term->parent,
			)
		);

		$wp_taxonomies = $temp_taxonomies;

		return $new_term;
	}

}

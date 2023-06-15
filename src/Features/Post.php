<?php

namespace WpifyMultilang\Features;

use WpifyMultilang\Managers\RepositoryManager;
use WpifyMultilang\Repositories\TranslationRepository;

class Post {
	const OBJECT_TYPE = 'post';

	public function __construct(
		private TranslationRepository $translation_repository,
		private RepositoryManager $repository_manager,
		private Relations $relations,
		private Settings $settings,
		private Term $term
	) {
	}

	/**
	 * Translate post.
	 *
	 * @param  int  $post_id  Post ID.
	 * @param  string  $post_type  Post type.
	 * @param  int  $target_site_id
	 * @param  bool  $copy_content  Copy content.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function translate_post( int $post_id, string $post_type, int $target_site_id, bool $copy_content = true ) {
		if ( ! $this->settings->is_post_type_translatable( $post_type ) ) {
			throw new \Exception( 'Post type is not translatable' );
		}

		return $this->create_remote_post( $post_id, $target_site_id, $copy_content, $post_type );
	}


	/**
	 * Create post on subsite
	 *
	 * @param  int  $source_post_id  Source post ID.
	 * @param  int  $target_site_id  Target Site ID.
	 * @param  bool  $copy_content  Copy content.
	 *
	 * @return int
	 * @throws \Wpify\Model\Exceptions\NotFoundException
	 * @throws \Wpify\Model\Exceptions\NotPersistedException
	 */
	public function create_remote_post( int $source_post_id, int $target_site_id, bool $copy_content, string $post_type ): int {
		$translation = $this->translation_repository->get_linked_translation( get_current_blog_id(), $source_post_id, $target_site_id, self::OBJECT_TYPE );

		if ( ! is_null( $translation ) ) {
			//	return $translation->site2_object_id;
		}

		$repo = $this->repository_manager->get_repository_by_post_type( $post_type );
		/** Post model. @var \WpifyMultilangDeps\Wpify\Model\Post $post */
		$post     = $repo->get( $source_post_id );
		$image_id = $post->featured_image_id;

		// Change defaults.
		$post->id          = 0;
		$post->post_status = 'draft';

		if ( ! $copy_content ) {
			$post->content = '';
			$post->excerpt = '';
		} else {
			$post->content = $this->prepare_content_for_subsite( $post->content, $target_site_id );
		}

		$taxonomies = get_object_taxonomies( $post_type );

		$terms = [];
		foreach ( $taxonomies as $taxonomy ) {
			if ( $this->settings->is_taxonomy_translatable( $taxonomy ) ) {
				$object_terms = wp_get_object_terms( $source_post_id, $taxonomy );
				if ( ! empty( $object_terms ) ) {
					$term_repo = $this->repository_manager->get_repository_by_taxonomy( $taxonomy );
					foreach ( $object_terms as $object_term ) {
						$terms[ $taxonomy ][] = $term_repo->get( $object_term->term_id );
					}
				}
			}
		}


		switch_to_blog( $target_site_id );

		// Save post.
		$post = $repo->save( $post );

		// Image.
		// TODO: Handle images.

		// TODO: Handle terms.

		restore_current_blog();

		$this->relations->link_objects( get_current_blog_id(), $source_post_id, $target_site_id, $post->id, self::OBJECT_TYPE );

		foreach ( $terms as $tax => $terms ) {
			$taxonomy = get_taxonomy( $tax );
			if ( ! $taxonomy || is_wp_error( $taxonomy ) ) {
				continue;
			}
			foreach ( $terms as $term ) {
				$term_id = $this->term->translate_term( $term->id, $tax, $target_site_id );
			}

		}


		return $post->id;
	}

	/**
	 * Prepare content for subsite.
	 *
	 * @param  string  $content  Content.
	 * @param  int  $target_site_id  Target site ID.
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function prepare_content_for_subsite( string $content, int $target_site_id ): string {
		$content = str_replace( '\\', '\\\\', $content );
		$content = $this->replace_reusable_blocks( $content, $target_site_id );

		return $content;
	}

	/**
	 * Replace reusable blocks in content.
	 *
	 * @param  string  $content  Content.
	 * @param  int  $target_site_id  Target site ID.
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function replace_reusable_blocks( string $content, int $target_site_id ): string {
		preg_match_all( '/<!-- wp:block {"ref":(\d+)} \/-->/m', $content, $matches );
		$block_placeholders = $matches[0];
		$block_ids          = $matches[1];

		foreach ( $block_ids as $index => $block_id ) {
			$translation = $this->translation_repository->get_linked_translation( $block_id, $target_site_id, 'post' );
			if ( is_null( $translation ) ) {
				$remote_block_id = $this->create_remote_post( $block_id, $target_site_id, true, 'wp_block' );
			} else {
				$remote_block_id = $translation->target_object_id;
			}
			$remote_block_placeholder = str_replace( $block_id, $remote_block_id, $block_placeholders[ $index ] );
			$content                  = str_replace( $block_placeholders[ $index ], $remote_block_placeholder, $content );
		}

		return $content;
	}

}

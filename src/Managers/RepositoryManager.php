<?php

namespace WpifyMultilang\Managers;

use WpifyMultilang\Features\Settings;
use WpifyMultilang\Repositories\PostTypeRepository;
use WpifyMultilang\Repositories\SiteRepository;
use WpifyMultilang\Repositories\TermRepository;
use WpifyMultilang\Repositories\TranslationRepository;
use WpifyMultilangDeps\Wpify\Model\Manager;

class RepositoryManager {
	public function __construct(
		private Manager $manager,
		private Settings $settings,
		TranslationRepository $translation_repository,
		SiteRepository $site_repository
	) {
		$this->manager->register_repository( $translation_repository );
		$this->manager->register_repository( $site_repository );

		$repo = new PostTypeRepository( $this->settings->get_translatable_post_types() );
		$this->manager->register_repository( $repo );
		$repo = new TermRepository();
		$this->manager->register_repository( $repo );
	}

	public function get_repository_by_post_type( string $post_type ) {
		foreach ( $this->manager->get_repositories() as $repository ) {
			if ( is_a( $repository, PostTypeRepository::class ) ) {
				return $repository;
			}
		}

		return null;
	}

	public function get_repository_by_taxonomy( string $taxonomy ) {
		foreach ( $this->manager->get_repositories() as $repository ) {
			if ( is_a( $repository, TermRepository::class ) ) {
				$repository->set_taxonomy( $taxonomy );

				return $repository;
			}
		}


		return null;
	}
}

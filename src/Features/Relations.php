<?php

namespace WpifyMultilang\Features;

use WpifyMultilang\Models\Translation;
use WpifyMultilang\Repositories\TranslationRepository;

class Relations {
	public function __construct(
		private TranslationRepository $translation_repository
	) {
	}

	/**
	 * @param  int  $source_object_id  Source Object ID.
	 * @param  int  $target_site_id  Target Site ID.
	 * @param  int  $target_object_id  Target Object ID.
	 * @param  string  $object_type  Object Type.
	 *
	 * @return Translation
	 * @throws \Exception Exception.
	 */
	public function link_objects( int $site1_id, int $site1_object_id, int $site2_id, int $site2_object_id, string $object_type ): Translation {
		$translation = $this->translation_repository->get_linked_translation( $site1_id, $site1_object_id, $site2_id, $object_type );
		if ( $translation ) {
			return $translation;
		}

		$translation                   = $this->translation_repository->create();
		$translation->site1_id         = $site1_id;
		$translation->site1_object_id  = $site1_object_id;
		$translation->site2_id         = $site2_id;
		$translation->site2_object_id  = $site2_object_id;
		$translation->object_type      = $object_type;
		$this->translation_repository->save( $translation );

		return $translation;
	}
}

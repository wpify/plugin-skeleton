<?php

namespace WpifyMultilang\Repositories;

use WpifyMultilang\Models\Translation;
use WpifyMultilangDeps\Wpify\Model\CustomTableRepository;
use WpifyMultilangDeps\Wpify\Model\Interfaces\ModelInterface;

/**
 * @method Translation create( array $data = array() )
 */
class TranslationRepository extends CustomTableRepository {

	public function table_name(): string {
		return 'wpify_multilang_translations';
	}

	public function model(): string {
		return Translation::class;
	}

	public function find_by_multiple( array $fields, bool $include_deleted = false ) {
		$query = array();
		foreach ( $fields as $field => $value ) {
			$query[] = $this->db()->prepare( "{$field} = %s", $value );
		}
		$where = implode( ' AND ', $query );

		return $this->find(
			array(
				'where'           => $where,
				'include_deleted' => $include_deleted,
			)
		);
	}


	/**
	 * @param  int  $source_object_id  Source Object ID.
	 * @param  int  $target_site_id  Target Site ID.
	 * @param  string  $object_type  Object Type.
	 *
	 * @return Translation|null
	 */
	public function get_linked_translation( int $source_object_id, int $target_site_id, string $object_type ): ?Translation {
		$translation = $this->find_by_multiple(
			array(
				'source_object_id' => $source_object_id,
				'target_site_id'   => $target_site_id,
				'object_type' => $object_type,
			)
		);

		return empty( $translation ) ? null : $translation[0];
	}
}

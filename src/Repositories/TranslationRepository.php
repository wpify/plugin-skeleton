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
	 * @param $site1_id
	 * @param  int  $object_id
	 * @param  int  $site2_id
	 * @param  string  $object_type  Object Type.
	 *
	 * @return Translation|null
	 */
	public function get_linked_translation( $site1_id, int $object_id, int $site2_id, string $object_type ): ?Translation {
		$translation = $this->find_by_multiple(
			array(
				'site1_id'        => $site1_id,
				'site1_object_id' => $object_id,
				'site2_id'        => $site2_id,
				'object_type'     => $object_type,
			)
		);

		return empty( $translation ) ? null : $translation[0];
	}
}

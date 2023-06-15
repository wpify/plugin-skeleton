<?php

namespace WpifyMultilang\Repositories;

use WpifyMultilangDeps\Wpify\Model\Term;

class TermRepository extends \WpifyMultilangDeps\Wpify\Model\TermRepository {
	private $taxonomy = '';

	public function set_taxonomy( string $taxonomy ): void {
		$this->taxonomy = $taxonomy;
	}

	public function taxonomy(): string {
		return $this->taxonomy;
	}

	public function __construct( private string $model = '' ) {
	}

	public function model(): string {
		return $this->model ?: Term::class;
	}
}

<?php

namespace WpifyMultilang\Repositories;

use WpifyMultilangDeps\Wpify\Model\Post;
use WpifyMultilangDeps\Wpify\Model\PostRepository;
use WpifyMultilangDeps\Wpify\Model\Term;

class TermRepository extends \WpifyMultilangDeps\Wpify\Model\TermRepository {
	public function __construct( private string $taxonomy, private string $model = '' ) {
	}

	public function taxonomy(): string {
		return $this->taxonomy;
	}

	public function model(): string {
		return $this->model ?: Term::class;
	}
}

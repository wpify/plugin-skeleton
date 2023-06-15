<?php

namespace WpifyMultilang\Repositories;

use WpifyMultilang\Models\Post;
use WpifyMultilangDeps\Wpify\Model\PostRepository;

class PostTypeRepository extends PostRepository {
	public function __construct( private array $post_types = [], private string $model = '' ) {
	}

	public function post_types(): array {
		return $this->post_types;
	}

	public function model(): string {
		return $this->model ?: Post::class;
	}
}

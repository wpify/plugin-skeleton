<?php

namespace WpifyPlugin\Controllers;

use WpifyPlugin\Controller;
use WpifyPlugin\Models\BookModel;
use WpifyPlugin\Repositories\BookRepository;

class BookController extends Controller {
	public function get_book( $book ) {
		/** @var BookRepository $repository */
		$repository = $this->plugin->get_repository( BookRepository::class );

		/** @var BookModel $book */
		return $repository->get( $book );
	}
}

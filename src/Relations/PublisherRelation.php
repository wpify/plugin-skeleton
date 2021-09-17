<?php

namespace WpifyPluginSkeleton\Relations;

use WpifyPluginSkeleton\Models\BookModel;
use WpifyPluginSkeleton\Repositories\BookRepository;
use WpifyPluginSkeleton\Repositories\PublisherRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\Interfaces\RelationInterface;

class PublisherRelation implements RelationInterface {
	private $book_model;
	private $book_repository;
	private $publisher_repository;

	public function __construct(
		BookModel $book_model,
		BookRepository $book_repository,
		PublisherRepository $publisher_repository
	) {
		$this->book_model           = $book_model;
		$this->book_repository      = $book_repository;
		$this->publisher_repository = $publisher_repository;
	}

	public function fetch() {
		$publishers = $this->publisher_repository->terms_of_post( $this->book_model->id );

		foreach ( $publishers as $publisher ) {
			return $publisher;
		}

		return null;
	}

	public function assign() {
		$this->book_repository->assign_post_to_term( $this->book_model, array( $this->book_model->publisher ) );
	}
}

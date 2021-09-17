<?php

namespace WpifyPluginSkeleton\Models;

use WpifyPluginSkeleton\Relations\PublisherRelation;
use WpifyPluginSkeleton\Repositories\BookRepository;
use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractPostModel;

/**
 * @method BookRepository model_repository()
 */
class BookModel extends AbstractPostModel {
	/** @var string */
	public $isbn;

	/** @var string */
	public $author_name;

	/** @var int */
	public $publisher_id;

	/** @var PublisherModel */
	public $publisher;

	/** @var int */
	public $rating;

	public function publisher_relation() {
		return new PublisherRelation(
			$this,
			$this->model_repository(),
			$this->model_repository()->get_publisher_repository()
		);
	}
}

<?php

namespace WpifyPluginSkeleton\Models;

use WpifyPluginSkeletonDeps\Wpify\Model\Abstracts\AbstractTermModel;

class PublisherModel extends AbstractTermModel {
	/** @var string */
	public $url;

	/** @var int */
	public $logo;
}

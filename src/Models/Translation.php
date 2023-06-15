<?php

namespace WpifyMultilang\Models;

use WpifyMultilangDeps\Wpify\Model\Attributes\Column;
use WpifyMultilangDeps\Wpify\Model\Model;

class Translation extends Model {
	#[Column( type: Column::INT, auto_increment: true, primary_key: true )]
	public int $id = 0;

	#[Column( type: Column::INT )]
	public int $source_object_id = 0;
	#[Column( type: Column::INT )]
	public int $target_object_id = 0;

	#[Column( type: Column::INT )]
	public int $source_site_id = 0;

	#[Column( type: Column::INT )]
	public int $target_site_id = 0;

	#[Column( type: Column::VARCHAR )]
	public string $object_type = '';

}

<?php

use WpifyPlugin\Controllers\BookController;

/** @var BookController $controller */
$controller = wpify_plugin()->get_controller( BookController::class );
$book       = $controller->get_book( get_queried_object_id() );

get_header();
?>
	<h1><?php echo sprintf( __( 'Book %s by %s', 'wpify-plugin' ), $book->get_title(), $book->get_author() ); ?></h1>
	<p>
		<?php echo sprintf( __( 'ISBN: %s', 'wpify-plugin' ), $book->get_isbn() ); ?>
	</p>
	<div class="content">
		<?php echo $book->get_content(); ?>
	</div>
<?php
get_footer();

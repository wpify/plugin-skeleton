<?php

use WpifyPluginSkeleton\Models\BookModel;

if ( empty( ABSPATH ) ) {
	exit;
}

/**
 * @var $args array Template arguments
 * @var string $note
 * @var BookModel $book
 */

$note = $args['note'];
$book = $args['book'];

if ( empty( $book ) ) {
	exit;
}
?>
<div class="block-book">
	<h2>
		<?= sprintf(
				__( '<a href="%s">%s</a> by %s', 'wpify-plugin-skeleton' ),
				get_permalink( $book->id ),
				$book->title,
				$book->author_name
		) ?>
	</h2>
	<?php if ( ! empty( $note ) ): ?>
		<p>
			<em><?php echo $note; ?></em>
		</p>
	<?php endif; ?>
</div>

<?php

use WpifyPluginSkeleton\Repositories\BookRepository;

$book_repository = wpify_plugin_skeleton_container()->get( BookRepository::class );
$book            = $book_repository->get( get_post() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h3>
		<a href="<?= esc_attr( get_permalink() ) ?>">
			<?= $book->title ?>
		</a>
	</h3>
	<dl>
		<dt><?= __( 'Author:', 'wpify-plugin-skeleton' ) ?></dt>
		<dd><?= $book->author_name ?></dd>
	</dl>
</article>

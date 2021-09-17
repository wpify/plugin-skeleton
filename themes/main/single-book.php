<?php

use WpifyPluginSkeleton\Repositories\BookRepository;

$book_repository = wpify_plugin_skeleton_container()->get( BookRepository::class );
$book            = $book_repository->get( get_post() );

get_header();
?>
	<h1><?php echo sprintf( __( '<strong>%s</strong> <small>by %s</small>', 'wpify-plugin-skeleton' ), $book->title, $book->author_name ); ?></h1>
<?php
if ( has_post_thumbnail( $book->id ) ) {
	the_post_thumbnail( $book->id );
}
?>
	<dl>
		<?php if ( ! empty( $book->isbn ) ): ?>
			<dt>
				<?php _e( 'ISBN', 'wpify-plugin-skeleton' ); ?>
			</dt>
			<dd>
				<?= $book->isbn; ?>
			</dd>
		<?php endif; ?>
		<?php if ( ! empty( $book->author_name ) ): ?>
			<dt>
				<?php _e( 'Author', 'wpify-plugin-skeleton' ); ?>
			</dt>
			<dd>
				<?= $book->author_name; ?>
			</dd>
		<?php endif; ?>
		<?php if ( ! empty( $book->rating ) ): ?>
			<dt>
				<?php _e( 'Rating', 'wpify-plugin-skeleton' ); ?>
			</dt>
			<dd>
				<?= $book->rating; ?>
			</dd>
		<?php endif; ?>
		<?php if ( ! empty( $book->publisher ) ): ?>
			<dt>
				<?php _e( 'Publisher', 'wpify-plugin-skeleton' ); ?>
			</dt>
			<dd>
				<a href="<?= esc_attr( get_term_link( $book->publisher->id, $book->publisher->taxonomy_name ) ) ?>">
					<?= $book->publisher->name; ?>
				</a>
			</dd>
		<?php endif; ?>
	</dl>
	<div class="content">
		<h3><?php _e( 'Book description', 'wpify-plugin-skeleton' ); ?></h3>
		<?php echo $book->content; ?>
	</div>
<?php
get_footer();

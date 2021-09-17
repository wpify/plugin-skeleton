<?php

use WpifyPluginSkeleton\PostTypes\BookPostType;

?>
<p>
	<?php
	echo sprintf(
			__( '<a href="%s">Show all the books</a>', 'wpify-plugin-skeleton' ),
			get_post_type_archive_link( BookPostType::KEY )
	);
	?>
</p>
<?php the_content(); ?>

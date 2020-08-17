<?php

use WpifyPlugin\Controllers\FrontPageController;

/** @var FrontPageController */
$controller = wpify()->get_controller(FrontPageController::class);

$posts = $controller->get_posts();
?>
<pre>Total number of posts: <?php echo count($posts); ?></pre>

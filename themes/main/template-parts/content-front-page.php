<?php

use Wpify\Controllers\HomeController;

/** @var HomeController */
$controller = wpify()->get_controller(HomeController::class);

$posts = $controller->get_posts();
?>
<pre>Total number of posts: <?php echo count($posts); ?></pre>

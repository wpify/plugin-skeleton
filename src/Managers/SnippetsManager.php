<?php

namespace WpifyPluginSkeleton\Managers;

use WpifyPluginSkeletonDeps\Wpify\Snippets\CopyrightShortcode;
use WpifyPluginSkeletonDeps\Wpify\Snippets\RemoveAccentInFilenames;

final class SnippetsManager {
	public function __construct(
		RemoveAccentInFilenames $remove_accent_in_filenames,
		CopyrightShortcode $copyright_shortcode
	) {
	}
}

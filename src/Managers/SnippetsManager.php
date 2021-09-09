<?php

namespace WpifyPluginSkeleton\Managers;

use Wpify\Snippets\CopyrightShortcode;
use Wpify\Snippets\RemoveAccentInFilenames;

final class SnippetsManager {
	public function __construct(
		RemoveAccentInFilenames $remove_accent_in_filenames,
		CopyrightShortcode $copyright_shortcode
	) {
	}
}

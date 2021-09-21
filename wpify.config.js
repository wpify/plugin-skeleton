module.exports = {
	wordPressUrl: 'https://www.wpify-plugin-skeleton.test',
	config: {
		build: 'build',
		entry: {
			'plugin': ['./assets/plugin.js', './assets/plugin.scss'],
			'block-editor': './assets/block-editor.js',
			'editor-style': './assets/editor-style.scss'
		},
	},
	webpack: (config) => {
		return config;
	},
	browserSync: (config) => {
		return config;
	},
	copy: {
		'editor-style.css': 'themes/main/editor-style.css',
	},
};

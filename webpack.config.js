const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry: {
		'plugin': ['./assets/plugin.js', './assets/plugin.scss'],
		'block-editor': './assets/block-editor.js',
		'editor-style': './assets/editor-style.scss'
	}
};

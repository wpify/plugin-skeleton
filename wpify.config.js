module.exports = {
  config: {
    build: 'build',
    entry: {
      'plugin': './assets/plugin.jsx',
      'home': './assets/home.scss',
      'some-module': './assets/some-module.scss',
      'button': './assets/button.scss',
      'block-editor': './assets/block-editor.js',
      'blocks-test-backend': './assets/blocks/test-block.jsx',
    },
  },
  webpack: (config) => {
    return config;
  },
  browserSync: (config) => {
    return config;
  },
};

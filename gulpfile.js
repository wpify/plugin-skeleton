const fs = require('fs');
const path = require('path');
const gulp = require('gulp');
const webpack = require('webpack');
const webpackConfig = require('./webpack.config');

/**
 * Define assets that needs to be copied somewhere else after compilation
 */
const assetsToCopy = {
  'block-editor.css': path.resolve('./themes/main/editor-style.css'),
};

/**
 * Runs Webpack compilation
 * @param mode
 * @param callback
 * @returns {Promise<void>}
 */
const runWebpack = async (mode, callback) => {
  const watch = mode === 'development';

  webpack({ mode, watch, ...webpackConfig }, (err, stats) => {
    if (err) {
      console.error('Webpack', err);
    }

    callback();
  });
};

/**
 * Runs webpack compilation for particular mode (development|production)
 * @param mode
 * @returns {function(*=): Promise<void>}
 */
const assets = (mode) => async (callback) => runWebpack(mode, callback);

/**
 * Copy compiled assets to a different location
 * @param callback
 */
const copyAssets = (callback) => {
  if (fs.existsSync(path.resolve('./build/assets-manifest.json'))) {
    const manifest = require('./build/assets-manifest.json');

    Object.keys(assetsToCopy)
      .filter((source) => fs.existsSync(path.resolve(`./build/${manifest[source]}`)))
      .forEach((source) => fs.copyFileSync(
        path.resolve(`./build/${manifest[source]}`),
        path.resolve(assetsToCopy[source]),
      ));
  }
  callback();
};

/**
 * Watch for changes in assets-manifest and run the copy after change
 * @param callback
 */
const watchAssets = (callback) => {
  gulp.watch('build/assets-manifest.json', copyAssets);
  callback();
};

/**
 * Task for development - watch changes in assets and recompile
 */
exports.start = gulp.parallel(
  watchAssets,
  assets('development'),
);

/**
 * Task for production build
 */
exports.build = gulp.series(assets('production'), copyAssets);

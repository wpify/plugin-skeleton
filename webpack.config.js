const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const PnpWebpackPlugin = require('pnp-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const eslintCodeframeFormatter = require('eslint-codeframe-formatter');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const StylelintWebpackPlugin = require('stylelint-webpack-plugin');
const stylelintFormatterPretty = require('stylelint-formatter-pretty');
const imageminGifsicle = require('imagemin-gifsicle');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminPngquant = require('imagemin-pngquant');
const imageminSvgo = require('imagemin-svgo');
const WebpackManifestPlugin = require('webpack-manifest-plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const packagejson = require('./package.json');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');
const notifier = require('node-notifier');
const FixStyleWebpackPlugin = require('@wordpress/scripts/config/fix-style-webpack-plugin')

const isDevelopment = (process.env.NODE_ENV === 'development');

module.exports = {
  entry: {
    'plugin': './assets/plugin.jsx',
    'home': './assets/home.scss',
    'some-module': './assets/some-module.scss',
    'button': './assets/button.scss',
    'block-editor': './assets/block-editor.js',
  },
  output: {
    path: path.resolve(__dirname, 'build'), // where to put compiled files to
    filename: `[name].v${packagejson.version}.js`,
    chunkFilename: `[name].v${packagejson.version}.js`,
    jsonpFunction: '_wpifyjsonp', // pick the unique jsonp function name, so the react apps doesn't collide
    pathinfo: false,
  },
  devtool: isDevelopment ? 'cheap-module-eval-source-map' : 'source-map',
  stats: {
    children: false,
    chunks: false,
    colors: true,
    depth: false,
    env: true,
    modules: false,
    reasons: false,
  },
  resolve: {
    symlinks: false,
    plugins: [PnpWebpackPlugin],
    extensions: ['.js', '.json', '.jsx'],
  },
  resolveLoader: {
    plugins: [PnpWebpackPlugin.moduleLoader(module)],
  },
  externals: { // We don't need to bundle some libraries that are already included in WordPress
    'react': 'React',
    'react-dom': 'ReactDOM',
    'jquery': 'jQuery',
  },
  optimization: {
    splitChunks: {
      chunks: 'all', // This allows us to split the code into small chunks that loads faster
    },
    minimizer: isDevelopment ? undefined : [
      new TerserJSPlugin({}),
      new OptimizeCSSAssetsPlugin({}),
    ],
  },
  module: {
    strictExportPresence: true,
    rules: [
      {
        parser: {
          requireEnsure: false,
        },
      },
      { // check the code with eslint during compilation
        test: /\.jsx?$/,
        exclude: /node_modules/,
        enforce: 'pre',
        use: [
          {
            loader: require.resolve('eslint-loader'),
            options: {
              formatter: eslintCodeframeFormatter,
            },
          },
        ],
      },
      { // compile js and jsx files with babel
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: [
          {
            loader: require.resolve('babel-loader'),
          },
        ],
      },
      { // We want to handle (s)css files, but CSS modules will be handled differentlys
        test: /\.s?css$/,
        exclude: /\.module\.s?css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              sourceMap: true,
            },
          },
          {
            loader: require.resolve('css-loader'),
            options: {
              sourceMap: true,
              importLoaders: 2,
            },
          },
          {
            loader: require.resolve('postcss-loader'),
            options: {
              sourceMap: true,
            },
          },
          {
            loader: require.resolve('sass-loader'),
            options: {
              sourceMap: true,
              implementation: require('sass'),
            },
          },
        ],
      },
      { // CSS modules can be used in React application
        test: /\.s?css$/,
        include: /\.module\.s?css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              sourceMap: true,
            },
          },
          {
            loader: require.resolve('css-loader'),
            options: {
              sourceMap: true,
              importLoaders: 2,
              modules: true,
            },
          },
          {
            loader: require.resolve('postcss-loader'),
            options: {
              sourceMap: true,
            },
          },
          {
            loader: require.resolve('sass-loader'),
            options: {
              sourceMap: true,
              implementation: require('sass'),
            },
          },
        ],
      },
      { // load the fonts
        test: /.(eot|woff|woff2|ttf|otf)$/,
        loader: require.resolve('file-loader'),
        options: {
          name: `[name].v${packagejson.version}.[ext]`,
          outputPath: 'fonts',
        },
      },
      { // load and optimise images
        test: /\.(gif|jpg|png|svg)$/,
        use: [
          {
            loader: require.resolve('url-loader'),
            options: {
              limit: 8192,
              name: `[name].v${packagejson.version}.[ext]`,
              outputPath: 'images',
            },
          },
          {
            loader: require.resolve('img-loader'),
            options: {
              plugins: !isDevelopment && [
                imageminGifsicle({
                  interlaced: false,
                }),
                imageminMozjpeg({
                  progressive: true,
                  arithmetic: false,
                }),
                imageminPngquant({
                  floyd: 0.5,
                  speed: 2,
                }),
                imageminSvgo({
                  plugins: [
                    {removeTitle: true},
                    {cleanupAttrs: true},
                    {removeXMLProcInst: true},
                    {removeComments: true},
                    {removeMetadata: true},
                    {removeXMLNS: false},
                    {removeEditorsNSData: true},
                    {removeEmptyAttrs: true},
                    {convertPathData: true},
                    {convertTransform: true},
                    {removeUnusedNS: true},
                    {mergePaths: true},
                    {convertShapeToPath: true},
                  ],
                }),
              ],
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin({ // Clean build folder when compilation starts
      cleanStaleWebpackAssets: false,
    }),
    isDevelopment && new LiveReloadPlugin({ // Auto reload the page during development
      appendScriptTag: true,
      protocol: 'http',
      hostname: 'localhost',
    }),
    new MiniCssExtractPlugin({ // Extract CSS files
      filename: `[name].v${packagejson.version}.css`,
    }),
    new StylelintWebpackPlugin({ // Check the CSS with stylelint
      formatter: stylelintFormatterPretty,
    }),
    new WebpackManifestPlugin({
      fileName: 'assets-manifest.json', // This file helps us with loading the assets in WordPress
    }),
    new FriendlyErrorsWebpackPlugin({ // This will make the errors nicer in console
      onErrors: (severity, errors) => {
        if (severity !== 'error') {
          return;
        }
        const error = errors[0];
        notifier.notify({
          title: 'Webpack error',
          message: severity + ': ' + error.name,
          subtitle: error.file || '',
        });
      }
    }),
    new DependencyExtractionWebpackPlugin({
      injectPolyfill: true,
      combineAssets: true,
    }),
    new FixStyleWebpackPlugin(),
  ].filter(Boolean),
};

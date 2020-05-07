# WPify plugin boilerplate

## Todo

[ ] Make naming compatible with https://www.php-fig.org/bylaws/psr-naming-conventions/
[ ] Create example taxonomy
[ ] Create controllers
[ ] Make basic theme
[ ] Example of custom tables

## Benefits

### I'm a plugin

The boilerplate is written as a plugin, that registers the theme directory. The reason for this design is that I had in the past several multi-site projects, that shares the same functionality, but sites have different themes. Splitting functionality and themes provides the best solution. Themes should take care only about templates, not a functionality.

### Separated functionality

Another idea is splitting the functionality into self-contained classes. We want to prevent a spaghetti code and have the related code together.

### Using modern front-end technologies

The build process utilizes the PostCSS, Autoprefixer, SCSS so that you can use all the modern possibilities you can imagine. For example, full support of CSS grid. You can also use CSS modules, ES2020 syntax, async/await, import(), etc.

### Prepared to React

Build process is also prepared to React, feel free to try it ;)

### Uses modern tools

The boilerplate uses composer (for dependencies and PHP autoloading), Yarn (for managing dependencies for front-end), Webpack (to build the assets).

## How to initialize the plugin

1. Clone the directory to the `wp-content/plugins/wpify`
2. Go to the directory `wp-content/plugins/wpify`
3. Run the commands `composer install`, `yarn install` and `yarn build`
4. Activate the plugin and the default theme
5. For development run `yarn start` command

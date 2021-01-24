const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('public/sass/app.scss', 'public/css').version();
mix.styles('public/css/custom.css', 'public/css/custom.css').version();
mix.scripts([
    'public/js/vendor/jquery.js',
    'public/js/vendor/poper.js',
    'public/js/vendor/bootstrap.js',
    'public/js/vendor/jquery-migrate.js',
    'public/js/vendor/jquery-ui.js',
    'public/js/vendor/jquery-validate.js',
    'public/js/vendor/jquery-scrollbar.js',
    'public/js/vendor/jquery-touch-punch.js',
    'public/js/vendor/sweetalert.js',
    'public/js/vendor/lazyload.js',
    'public/js/vendor/core.js'
],'public/js/vendor.js').version();
mix.scripts('public/js/dev.js', 'public/js/app.js').version();

const {mix} = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/staff/app.js', 'public/js/staff')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .less('node_modules/bootstrap-rtl/less/bootstrap-rtl.less', 'public/css')
    .browserSync('dev.komakyar.mohammad.inpin.co');

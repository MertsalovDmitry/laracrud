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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js', 'public/js' )
   .copy('node_modules/moment/min/moment.min.js', 'public/js' )
   .copy('node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/js' )
   .copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'public/js' )
   .copy('node_modules/select2/dist/js/select2.full.min.js', 'public/js' )
   .copy('node_modules/datatables/media/js/jquery.dataTables.min.js', 'public/js' )
   .js('resources/js/laravel.js', 'public/js')
   .sass('resources/sass/laravel.scss', 'public/css/laravel.css');


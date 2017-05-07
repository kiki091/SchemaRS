const { mix } = require('laravel-mix');

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


// for plugin css
mix.styles([
    'public/themes/vendors/bootstrap/dist/css/bootstrap.css',
    'public/themes/vendors/font-awesome/css/font-awesome.css',
    'public/themes/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
    'public/themes/css/_popup.css',
    'public/themes/css/notify.css',
    'public/js/bower_components/hold-on/HoldOn.min.css',
    'public/js/bower_components/alert/dist/sweetalert.css',
    'public/js/bower_components/pacejs/pace-theme-flash.css'
], 'public/themes/build/css/core.css');

/* script compile */

mix.scripts([
	'public/js/bower_components/jquery/dist/jquery.min.js',
	'public/js/bower_components/jquery/dist/jquery-ui.js',
	'public/js/bower_components/pacejs/pace.js',
	'public/themes/js/function.js',
	'public/js/bower_components/notifyjs/dist/notify.js',
	'public/js/bower_components/hold-on/HoldOn.min.js',
	'public/themes/js/notify.js',
	'public/themes/js/plugins.js',
	'public/js/bower_components/alert/dist/sweetalert.min.js',
], 'public/themes/build/js/core.js');

/* script compile */

mix.scripts([
	'public/themes/vendors/bootstrap/dist/js/bootstrap.min.js',
	'public/themes/vendors/fastclick/lib/fastclick.js',
	'public/themes/vendors/pnotify/dist/pnotify.js',
	'public/themes/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	'public/themes/build/js/custom.min.js',
], 'public/themes/build/js/plugins.js');
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

mix.styles([
    '../assets/libs/jsvectormap/css/jsvectormap.min.css',
    '../assets/libs/swiper/swiper-bundle.min.css',
    '../assets/css/bootstrap.min.css',
    '../assets/css/icons.min.css',
    '../assets/css/app.min.css',
    '../assets/css/custom.min.css'
], '../css/app.css')
    .babel([
        '../assets/libs/bootstrap/js/bootstrap.bundle.min.js',
        '../assets/libs/simplebar/simplebar.min.js',
        '../assets/libs/node-waves/waves.min.js',
        '../assets/libs/feather-icons/feather.min.js',
        '../assets/js/pages/plugins/lord-icon-2.1.0.js',
        '../assets/js/plugins.js',
        '../assets/libs/apexcharts/apexcharts.min.js',
        '../assets/libs/jsvectormap/js/jsvectormap.min.js',
        '../assets/libs/jsvectormap/maps/world-merc.js',
        '../assets/libs/swiper/swiper-bundle.min.js',
        '../assets/js/pages/dashboard-ecommerce.init.js',
        '../assets/js/app.js',
    ], '../js/app.js');

mix.styles([
    '../assets/libs/jsvectormap/css/jsvectormap.min.css',
    '../assets/libs/select2/css/select2.min.css',
    '../assets/css/bootstrap.min.css',
    '../assets/css/icons.min.css',
    '../assets/css/app.min.css',
    '../assets/css/custom.min.css',
], '../css/style.css')
    .babel([
        '../assets/js/layout.js',
        '../assets/libs/bootstrap/js/bootstrap.bundle.min.js',
        '../assets/libs/simplebar/simplebar.min.js',
        '../assets/libs/node-waves/waves.min.js',
        '../assets/libs/feather-icons/feather.min.js',
        '../assets/js/pages/plugins/lord-icon-2.1.0.js',
        '../assets/libs/apexcharts/apexcharts.min.js',
        '../assets/libs/jsvectormap/js/jsvectormap.min.js',
        '../assets/libs/jsvectormap/maps/world-merc.js',
        '../assets/libs/swiper/swiper-bundle.min.js',
        '../assets/libs/select2/js/select2.min.js',
        '../assets/js/pages/dashboard-ecommerce.init.js',
        '../assets/js/app.js',
    ], '../js/script.js');

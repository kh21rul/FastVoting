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

// === Mix configuration for both production and development environments ===
mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');
mix.sourceMaps();

// === Mix configuration for development environment ===
if (!mix.inProduction()) {
    mix.disableNotifications();
    mix.browserSync(process.env.MIX_BROWSER_SYNC_URL);
}

// === Mix configuration for production environment ===
if (mix.inProduction()) {
    mix.version();
}

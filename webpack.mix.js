const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// === Mix configuration for both production and development environments ===
mix.js('resources/scripts/app.js', 'public/scripts');
mix.postCss('resources/styles/app.css', 'public/styles', [
    //
]);

// === Mix configuration for development environment ===
if (!mix.inProduction()) {
    mix.disableNotifications();
    mix.browserSync(process.env.MIX_BROWSER_SYNC_URL);
}

// === Mix configuration for production environment ===
if (mix.inProduction()) {
    mix.version();
}

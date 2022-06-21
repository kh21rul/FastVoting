const mix = require('laravel-mix');
const WebpackPwaManifest = require('webpack-pwa-manifest');
const path = require('path');

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

// Copy all assets to public folder
mix.copyDirectory('resources/assets', 'public/assets');

// Copy all third-party vendors to public folder
mix.copyDirectory('resources/vendor', 'public/vendor');

// Other plugins
mix.webpackConfig({
    plugins: [
        // PWA manifest generator
        // Documentation: https://github.com/arthurbergmz/webpack-pwa-manifest
        new WebpackPwaManifest({
            filename: 'web-manifest.json',
            name: 'FastVoting',
            short_name: 'FastVoting',
            description: 'Make your voting event feel easy',
            lang: 'en-US',
            display: 'standalone',
            orientation: 'portrait',
            inject: false,
            fingerprints: false,
            background_color: '#ffffff',
            theme_color: '#0d6efd',
            scope: '/',
            icons: [
                {
                    src: path.resolve('resources/assets/logo.png'),
                    sizes: [96, 128, 192, 256, 384, 512],
                    destination: path.join('assets/icons'),
                    purpose: 'any',
                },
                {
                    src: path.resolve('resources/assets/logo.png'),
                    sizes: [57, 60, 72, 76, 114, 120, 144, 152, 180],
                    destination: path.join('assets/icons'),
                    purpose: 'any',
                    ios: true,
                },
            ],
        }),
    ],
});

// Split the js files into manifest.js, vendor.js and app.js.
mix.extract();

// === Mix configuration for development environment ===
if (!mix.inProduction()) {
    mix.disableNotifications();
    mix.browserSync(process.env.MIX_BROWSER_SYNC_URL);
}

// === Mix configuration for production environment ===
if (mix.inProduction()) {
    mix.version();
}

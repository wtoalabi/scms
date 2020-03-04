const mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
/*
 |--------------------------------------------------------------------------
 | Aliases
 |--------------------------------------------------------------------------
 */
if (mix.inProduction()) {
    mix.webpackConfig({
        watchOptions: {
            ignored: /node_modules/,
        },
        plugins: [
            new purgeCss({
                //whitelistPatterns: [/(nav).*/,/(bg).*/, /(btn).*/],
                paths: glob.sync([
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/js/**/*.vue'),
                ]),
                extractors: [
                    {
                        extractor: class {
                            static extract(content) {
                                return content.match(/[A-z0-9-:\/]+/g)
                            }
                        },
                        extensions: ['html', 'js', 'php', 'vue']
                    }
                ]
            })
        ]
    }).version()
}
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.join(__dirname, 'resources/js/'),
            'node_modules': path.join(__dirname, 'node_modules')
        }
    }
});

mix.js('resources/js/admin/admin.js', 'public/js')
    .js('resources/js/account/account.js', 'public/js')
    .extract(['vue', 'lodash-es', 'axios'],'public/js/vendor.js')
    .options({
        extractVueStyles: true,
        globalVueStyles: 'resources/sass/custom/mixins.scss'
    })
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/account/account.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    plugins: [
        new VuetifyLoaderPlugin(),
        new LiveReloadPlugin()
    ]
}).sourceMaps();
mix.disableSuccessNotifications();

const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
// require('dotenv').config(); 

require('laravel-mix-purgecss');

mix.override((config) => {
    delete config.watchOptions;
});

mix
    .js('resources/js/app.js', 'public/js').vue()
    .sass('resources/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    })
    .purgeCss({
        enabled: true,
    });

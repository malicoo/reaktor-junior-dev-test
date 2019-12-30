const mix = require('laravel-mix');

require('mix-tailwindcss');

mix
    .js('frontend/js/app.js', 'public/js')
    .tailwind();
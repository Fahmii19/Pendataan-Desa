const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

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

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app-new.css", "public/css/app-new.css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .postCss("resources/css/panduan-new.css", "public/css/panduan-new.css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .postCss("resources/css/pandes.css", "public/css/pandes.css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ]);

mix.browserSync({
    proxy: "localhost:80",
});

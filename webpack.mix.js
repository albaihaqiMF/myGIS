const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/ckeditor-classic.js", "public/js")
    .js("resources/js/ckeditor-inline.js", "public/js")
    .js("resources/js/ckeditor-balloon.js", "public/js")
    .js("resources/js/ckeditor-balloon-block.js", "public/js")
    .js("resources/js/ckeditor-document.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .autoload({
        "cash-dom": ["cash"],
    })
    .copyDirectory("resources/json", "public/json")
    .copyDirectory("resources/fonts", "public/fonts")
    .copyDirectory("resources/images", "public/images")
    .browserSync({
        proxy: "tinker-html.test",
        files: ["resources/**/*.*"],
    });

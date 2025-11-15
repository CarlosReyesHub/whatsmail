const mix = require("laravel-mix");
const path = require("path");
mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
});
mix.js("resources/js/app.js", "public/js").vue();
mix.js("resources/js/app-template.js", "public/js").vue();
mix.js("resources/js/app-broadcast.js", "public/js").vue();
mix.js("resources/js/whatsapp-template.js", "public/js").vue();

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/assets/compiled/css/app.css",
                "resources/assets/compiled/css/app-dark.css",
                "resources/js/app.js",
                "resources/assets/static/js/initTheme.js",
                "resources/assets/static/js/components/dark.js",
                "resources/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js",
                "resources/assets/compiled/js/app.js",
                "resources/js/crud.js",
            ],
            refresh: true,
        }),
    ],
});

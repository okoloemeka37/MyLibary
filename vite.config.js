import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/sass/app.scss','resources/sass/Admin.scss','resources/js/app.js','resources/js/Admin.js','resources/js/comment&ratings.js'],
            refresh: true,
        }),
    ],
});

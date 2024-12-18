import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/text-to-speech.js'],
            refresh: true,
        }),
    ],
    resolve: {
    alias: {
        'laravel-echo': 'laravel-echo/dist/echo.js',
    },
},
});

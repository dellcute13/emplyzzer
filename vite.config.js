import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),   // <-- ini wajib untuk Tailwind v4
    ],
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
    },
});
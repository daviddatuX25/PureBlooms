import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const ngrokUrl = 'https://37ab-136-239-226-85.ngrok-free.app';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        allowedHosts: true,
        origin: ngrokUrl,
        hmr: {
            host: '0.0.0.0',
            clientPort: 5173,
        },
    },
});
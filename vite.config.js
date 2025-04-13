import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        watch: {
            usePolling: true,
        },
        hmr: {
            host: 'localhost',
            protocol: 'ws',
            port: 5173,
        },
    },
    build: {
        outDir: path.resolve(__dirname, 'public/build'),
    },
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

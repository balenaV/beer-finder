import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0', // Permite que o servidor Vite seja acessível externamente (Docker/WSL)
        hmr: {
             host: 'localhost', // Garante que o Hot Module Reloading funcione no WSL
        },
    },
});

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/adminadd.js',
                'resources/css/adminadd.css',
            ],
            refresh: true,
            publicDirectory: 'resources',
            buildDirectory: 'src',
        }),
    ],
})
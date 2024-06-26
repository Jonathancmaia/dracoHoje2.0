import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        https: true
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: "./",
                    includeAbsolute: false,
                },
            }
        }),
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    }
});

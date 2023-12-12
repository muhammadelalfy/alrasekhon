import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue';
import path from "path";
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'
import ElementPlus from 'unplugin-element-plus/vite'
import { resolve, dirname } from 'node:path'
import { fileURLToPath } from 'url'
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
import inject from '@rollup/plugin-inject';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/app/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        AutoImport({
            imports: [
                'pinia',
                {
                    '@/store': ['useStore'],
                }
            ],
            resolvers: [ElementPlusResolver()],
        }),
        Components({
            resolvers: [ElementPlusResolver()],
        }),
        VueI18nPlugin({
            /* options */
            runtimeOnly: false,
            // locale messages resource pre-compile option
            include: resolve(dirname(fileURLToPath(import.meta.url)), './path/to/src/locales/**'),
        }),
        inject({
            $: 'jquery',
        }),
        ElementPlus()
    ],
    resolve: {
        alias: [
            { find: '@', replacement: path.resolve(__dirname, './resources/app') },
            { find: '~', replacement: path.resolve(__dirname, './resources/sass') },
            { find: '@api', replacement: path.resolve(__dirname, './resources/app/api') },
            { find: '@views', replacement: path.resolve(__dirname, './resources/app/views') },
            { find: '@services', replacement: path.resolve(__dirname, './resources/app/services') },
            { find: '@providers', replacement: path.resolve(__dirname, './resources/app/providers') },
            { find: '@composables', replacement: path.resolve(__dirname, './resources/app/composables') },
            { find: vue, replacement: path.resolve(__dirname, './vue/dist/vue.esm-bundler.js') },
            { find: '~bootstrap', replacement: path.resolve(__dirname, './node_modules/bootstrap') },
        ],
    },
    server: {
        hmr: {
            host: 'localhost',
            protocol: "ws",
        },
    },
    build:{
        chunkSizeWarningLimit: 1600,
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }
    }
});

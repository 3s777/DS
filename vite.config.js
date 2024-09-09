import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import postcssCombineMediaQuery from 'postcss-combine-media-query'
import cssmqpacker from 'css-mqpacker';
import sortMediaQueries from 'postcss-sort-media-queries';


export default defineConfig({
    // server: {
    //     host: '127.0.0.1',  // Docker
    // },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    resolve:{
        alias:{
            '~' : '/node_modules/'
        },
    },
    css: {
        postcss: {
            plugins: [
                sortMediaQueries({sort: 'desktop-first'}),
            ],
        },
        // preprocessorOptions: {
        //     scss: {
        //         // additionalData: `$base: 129;`,
        //     }
        // }
    },
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/scss/admin.scss', 'resources/js/app.js', 'resources/js/scripts.js'],
            refresh: true,
        }),
    ],
});

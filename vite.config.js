import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import viteJoinMediaQueries from 'vite-join-media-queries';
import postcssCombineMediaQuery from 'postcss-combine-media-query'
import cssmqpacker from 'css-mqpacker';
import sortMediaQueries from 'postcss-sort-media-queries';


export default defineConfig({
    resolve:{
        alias:{
            '~' : '/node_modules/'
        },
    },
    css: {
        postcss: {
            plugins: [
                sortMediaQueries({sort: 'desktop-first'}),
                // cssmqpacker({ sort: true }),
                // postcssCombineMediaQuery
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
        // viteJoinMediaQueries({
        //     paths2css: ['./public/build/assets'],
        //     cssnanoConfig: { preset: 'default' },
        // }),
    ],
});

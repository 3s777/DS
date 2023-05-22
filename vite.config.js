import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import viteJoinMediaQueries from 'vite-join-media-queries';
import postcssCombineMediaQuery from 'postcss-combine-media-query'


export default defineConfig({
    resolve:{
        alias:{
            '~' : '/node_modules/'
        },
    },
    css: {
        postcss: {
            plugins: [
                postcssCombineMediaQuery
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
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        // viteJoinMediaQueries({
        //     paths2css: ['./public/build/assets'],
        //     cssnanoConfig: { preset: 'default' },
        // }),
    ],
});

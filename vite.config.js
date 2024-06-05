import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss',
            ],
            // publicDirectory: "../",
            refresh: true,
        }),
    ],
    server: {
        https: true,
        // host: 'si2x-production.up.railway.app',  // Ganti dengan domain Anda jika berbeda
        // port: 443,
    }
    // build: {
    //     outDir: 'public/build/vite',
    //     manifest: true,
    // },
});

// vite.config.js
// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//             buildDirectory: 'public/build',
//         }),
//     ],
//     build: {
//         outDir: 'public/build',
//         manifest: true,
//     },
// });

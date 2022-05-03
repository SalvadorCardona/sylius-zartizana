import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import pkg from './package.json'
import path from 'path'

process.env.VITE_APP_VERSION = pkg.version
if (process.env.NODE_ENV === 'production') {
    process.env.VITE_APP_BUILD_EPOCH = new Date().getTime().toString()
}

export default defineConfig({
    plugins: [
        vue({
            script: {
                refSugar: true,
            },
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './src'),
        },
    },
    build: {
        manifest: true,
        assetsDir: '',
        outDir: './../public/src/',
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
            input: {
                'main.ts': './src/main.ts',
            },
        },
    },
})

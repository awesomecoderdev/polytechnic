import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import react from "@vitejs/plugin-react";

export default defineConfig({
    server: {
        host: "api.polytechnic.co.bd",
        // host: "api.wpplagiarism.one",
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            valetTls: "api.polytechnic.co.bd",
            // valetTls: "api.wpplagiarism.one",
        }),
        // react(),
    ],
});

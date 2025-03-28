import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                palatino: ["Palatino", "serif"],
                roxborough: ["Roxborough", "serif"],
            },
            colors: {
                bblue: {
                    DEFAULT: "#4A90E2",
                },
                white: {
                    DEFAULT: "#F1F1F1",
                },
            },
        },
    },

    darkMode: "false",

    plugins: [forms],
};

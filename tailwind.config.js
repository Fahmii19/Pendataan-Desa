/** @type {import('tailwindcss').Config} */

//tailwin.config
module.exports = {
    purge: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    darkMode: false,
    theme: {
        extend: {
            padding: {
                "5px": "5px",
            },
            fontFamily: {
                roboto: "'Roboto', sans-serif",
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    fontFamily: {
        sans: ["Roboto", "sans-serif", "Arial"],
    },
    plugins: [
        require("tailwind-scrollbar"),
        require("tailwindcss"),
        require("autoprefixer"),
    ],
};

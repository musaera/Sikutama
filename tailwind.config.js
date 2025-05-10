/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class", // Menggunakan dark mode dengan class
    content: [
        "./resources/**/*.{blade.php,js,vue}", // Sesuaikan dengan struktur proyek
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("tailwindcss-animate"),
    ],
};

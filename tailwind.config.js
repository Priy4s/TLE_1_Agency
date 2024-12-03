import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        colors: {
            'violet' : '#aa0160',
            'violetdark' : '#7C1A51',
            'yellow' : '#FAEC02',
            'mossmedium' : '#92AA83',
            'mosslight' : '#E2ECC8',
            'mossdark' : '#2E342A',
            'green': '#313D29',
            'white' : '#FFFFFF',
            'cream' : '#FBFCF6',
            'strokethin' : '#DFDFDF'
        }
        },
    },
    plugins: [],
};

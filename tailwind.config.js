import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
            'mossmedium' : '#92AA83',
            'mosslight' : '#E2ECC8',
            'mossdark' : '#2E342A',
            'green': '#313D29',
            'white' : '#FFFFFF',
            'cream' : '#FBFCF6',
            'strokethin' : '#DFDFDF',
                'darkviolet' : '#7C1A61',
        }
        },
        },

    plugins: [forms],
};

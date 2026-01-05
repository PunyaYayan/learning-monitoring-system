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
                brand: {
                    bg: '#FAFAF8',
                    primary: '#A8CBBE',
                    secondary: '#FFF1B8',
                    header: '#0F5D3B',
                    text: '#1F2937',
                },
            },
        }
    },

    plugins: [forms],
};

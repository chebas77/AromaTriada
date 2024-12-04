import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/*/.blade.php',
        './storage/framework/views/*.php',
        './resources/views/*/.blade.php',
        './node_modules/swiper/swiper-bundle.min.js',
    ],
    safelist: [
        'swiper-container',
        'swiper-wrapper',
        'swiper-slide',
        'swiper-pagination',
        'swiper-pagination-bullet',
        'swiper-button-next',
        'swiper-button-prev',
    ],

    theme: {
        extend: {

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                beige: '#c5ae93', // Define el color beige personalizado
            },

        },
    },

    plugins: [forms, typography],
};
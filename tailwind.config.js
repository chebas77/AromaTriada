import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php', // Corrige la ruta y glob
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // Corrige la ruta
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/swiper/**/*.js', // Ruta correcta para Swiper
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
                beige: '#c5ae93',
                rojo: '#F28C8C',
                dorado: '#D6A46E',
         // Define el color beige personalizado
            },
        },
    },
    plugins: [forms, typography],
};

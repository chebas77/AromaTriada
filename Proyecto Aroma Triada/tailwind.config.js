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
    'animate-spin',  // Asegura que la animación de carga no se purgue
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        fascinate: ['Fascinate', 'cursive'],
      },

      colors: {
        beige: '#c5ae93', // Color beige personalizado
        violeta: '#A7727D', // Color violeta personalizado
        crema1: "#EDDBC7",
        crema2:"#F8EAD8",
        crema3:"#F9F5E7",
        'custom-hover': '#f3f3f3', // Color personalizado para hover
      },

    },
  },

  plugins: [forms, typography],
};

/* eslint-disable @typescript-eslint/no-var-requires */
import colors from 'tailwindcss/colors';
import config from './resources/js/fixtures/config';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.tsx',
  ],

  theme: {
    extend: {
      fontFamily: {
        fa: ['Vazirmatn', 'sans-serif'],
        'fa-display': ['Lalezar', 'sans-serif'],
      },
    },
    container: {
      center: true,
      padding: '1rem',
    },
  },
  daisyui: {
    themes: [
      {
        light: {
          ...require('daisyui/src/theming/themes')['light'],
          primary: config.primaryColor,
          'primary-content': colors.white,
          secondary: colors.pink['500'],
          error: colors.rose['600'],
        },
      },
    ],
  },
  plugins: [require('daisyui'), require('@tailwindcss/typography')],
};

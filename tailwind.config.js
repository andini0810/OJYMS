import tailwindcss from 'tailwindcss';
const defaultTheme = require('tailwindcss/defaultTheme')
export default {
    content: [
      "./**/*.php",
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily: {
            sans: ['InterVariable', ...defaultTheme.fontFamily.sans],
          },
      },
    },
    plugins: [],
  }
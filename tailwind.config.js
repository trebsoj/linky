/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#36cccc',
        secondary: '#6366f1',
        accent: '#f59e0b',
      },
    },
  },
  plugins: [],
}

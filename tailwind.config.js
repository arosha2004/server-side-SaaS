/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./includes/**/*.php",
    "./notes/**/*.php",
    "./admin/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        'nh-dark': '#000b1d',
        'nh-light-gray': '#d1d5db',
        'nh-blue': '#3b82f6',
        'nh-pink': '#db9d9d',
        'nh-purple': '#a5b4fc',
        'nh-search': '#c4c4c4',
        'nh-accent-pink': '#b28a8a',
      },
      borderRadius: {
        'nh-xl': '2rem',
        'nh-2xl': '3rem',
      }
    },
  },
  plugins: [],
}

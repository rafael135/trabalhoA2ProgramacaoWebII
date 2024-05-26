/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      backgroundImage: {
        "home": "url('/resources/img/bg.png')"
      }
    },
  },
  plugins: [
    require("flowbite/plugin")
  ],
}


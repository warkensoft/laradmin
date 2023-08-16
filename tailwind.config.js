/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/Resources/Views/**/*.{html,js,php}"],
  safelist: [
    'text-2xl',
    'text-3xl',
    'text-white',
    'text-black',
    'font-bold',
    'font-extrabold',
    {
      pattern: /bg-(red|green|yellow|blue|slate)-(50|100|200|300|600|700|800|900)/,
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


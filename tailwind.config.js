/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./public/**/*.php",
    "./public/**/*.html"
  ],
  theme: {
    extend: {
        colors: {
        brand: {
            primary: '#3066BE',
            secondary: '#963484',
            light: '#60AFFF',
        },
        techbg: '#F2F5FF',
        status: {
            aberto: '#F49097',
            atendimento: '#F5E960',
            concluido: '#55D6C2',
        },
        accent: '#DFB2F4'
        }
    },
  },
  plugins: [],
}
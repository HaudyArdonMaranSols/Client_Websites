/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        SideLightBlue: '#004AAD', // Tambahkan warna Hex-Code kustom
        SideDarkBlue: '#091057', // Contoh tambahan warna lain
        MainOrange: '#FD5F00',  // Contoh warna merah kustom
      },
    },
  },
  plugins: [],
}
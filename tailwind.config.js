module.exports = {
  content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
  theme: {
    extend: {
      colors: {
        primary: '#000000',
        soft: '#B6B09F',
        'soft-light': '#D2CFC4',
        'soft-dark': '#9A9482',
        accent: '#444444',
        highlight: '#F5F4EF',
      },
      fontFamily: {
        sans: ['"Instrument Sans"', 'ui-sans-serif', 'system-ui'],
      },
    },
  },
  plugins: [],
};

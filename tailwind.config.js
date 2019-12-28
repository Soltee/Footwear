module.exports = {
  theme: {
    extend: {
      screens:{
        'cm' : '400px'
      },
      zIndex: {
        '-10': '-1',
      },
      colors:{
        custom: {
          'gray': '#CCCCCC',
          'gray-light': '#4e4d38',
          'gray-lighter' : '#424041',
          'red-darker': '#cf1d1d',
          'red-lighter' : '#f43838',
          'red-light' : '#8a3231',
        }
      },
      height: {
        '86': '24rem'
      },
      width:{
        '400' : '400px',
        '500' : '500px',
        '900' : '900px'
      },
      maxHeight: {
        '24' : '24rem'
      } 
    }
  },
  variants: {
    margin: ['hover'],
  },
  plugins: []
}

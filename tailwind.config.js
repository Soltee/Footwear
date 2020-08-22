module.exports = {
    theme: {
        extend: {
            screens: {
                'cm': '400px',
                'cs': '1440px'
            },
            zIndex: {
                '-10': '-1',
            },
            colors: {
                custom: {
                    'gray': '#CCCCCC',
                    'gray-light': '#4e4d38',
                    'gray-lighter': '#424041',
                    'red-darker': '#cf1d1d',
                    'red-lighter': '#f43838',
                    'red-light': '#8a3231',
                    'light-black': '#333333',
                    'dark-orange': '#D65A21',
                    'light-orange': '#EE6425'
                },
                admin: {
                    'bk': '#c2c49f',
                    'btn': '#191911',
                    'btn-hover': '#6b6855',
                    'red': '#dd1515',
                    'green': '#159049',
                }
            },
            height: {
                '86': '24rem',
                '90': '28rem',
                '94': '32rem'
            },
            width: {
                '400': '400px',
                '500': '500px',
                '900': '900px'
            },
            maxHeight: {
                '24': '24rem'
            },
            opacity: {
                '90': '0.90',
                '95': '0.95',
            },
        },
        transitionProperty: { // defaults to these values
            'none': 'none',
            'all': 'all',
            'color': 'color',
            'bg': 'background-color',
            'border': 'border-color',
            'colors': ['color', 'background-color', 'border-color'],
            'opacity': 'opacity',
            'transform': 'transform',
        },
        transitionDuration: { // defaults to these values
            'default': '250ms',
            '0': '0ms',
            '100': '100ms',
            '250': '250ms',
            '500': '500ms',
            '750': '750ms',
            '1000': '1000ms',
        },
        transitionTimingFunction: { // defaults to these values
            'default': 'ease',
            'linear': 'linear',
            'ease': 'ease',
            'ease-in': 'ease-in',
            'ease-out': 'ease-out',
            'ease-in-out': 'ease-in-out',
        },
        transitionDelay: { // defaults to these values
            'default': '0ms',
            '0': '0ms',
            '100': '100ms',
            '250': '250ms',
            '500': '500ms',
            '750': '750ms',
            '1000': '1000ms',
        },
        willChange: { // defaults to these values
            'auto': 'auto',
            'scroll': 'scroll-position',
            'contents': 'contents',
            'opacity': 'opacity',
            'transform': 'transform',
        },
    },
    variants: {
        margin: ['hover'],
        transitionProperty: ['responsive'],
        transitionDuration: ['responsive'],
        transitionTimingFunction: ['responsive'],
        transitionDelay: ['responsive'],
        willChange: ['responsive'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        gridAutoFlow: ['responsive', 'hover', 'focus'],
    },
    plugins: [
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-transitions')(),
    ]
}

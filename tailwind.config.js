module.exports = {
    theme: {
        container: { center: true, padding: '3rem' },
        screens: {
            'sm': '500px',
            // => @media (min-width: 640px) { ... }

            'md': '700px',
            // => @media (min-width: 768px) { ... }

            'lg': '880px',
            // => @media (min-width: 1024px) { ... }

            'xl': '999px',
            // => @media (min-width: 1280px) { ... }
        },
        fontFamily: {
            'sans': [
                'Source Sans Pro', 'Ubuntu', 'sans-serif'
            ]
        },

        extend: {}
    },
    variants: {},
    plugins: []
}
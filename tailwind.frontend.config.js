/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/views/*.blade.php',
        './resources/views/partials/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './resources/views/sections/**/*.blade.php',
        './resources/views/products/**/*.blade.php',
        './resources/views/vendor/**/*.blade.php',
        './resources/views/auth/**/*.blade.php',
        './resources/views/layouts/app.blade.php',
        './resources/views/layouts/auth.blade.php',
        './resources/views/layouts/error.blade.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary:   { DEFAULT: '#2B5F3F', light: '#3A7B54', dark: '#1E4A2F' },
                accent:    { DEFAULT: '#D4864E', light: '#E0A070', dark: '#B56E38' },
                leaf:      { DEFAULT: '#6DAE82', light: '#8BC49D', dark: '#539968' },
                surface:   { DEFAULT: '#F9F8F6', dark: '#F0EEEA' },
                ink:       { DEFAULT: '#1A1A1A', light: '#333333' },
                ash:       { DEFAULT: '#737373', light: '#9CA3AF', dark: '#525252' },
                border:    { DEFAULT: '#E5E5E5', dark: '#D4D4D4' },
            },
            fontFamily: {
                display: ['"Playfair Display"', 'Georgia', 'serif'],
                body:    ['"Outfit"', 'system-ui', 'sans-serif'],
            },
            fontSize: {
                'hero':    ['clamp(2.25rem, 6vw, 5.5rem)', { lineHeight: '1.05', letterSpacing: '-0.02em' }],
                'heading': ['clamp(2rem, 4vw, 3.2rem)', { lineHeight: '1.15', letterSpacing: '-0.01em' }],
                'sub':     ['clamp(1.25rem, 2vw, 1.75rem)', { lineHeight: '1.3' }],
            },
            animation: {
                'fade-up':   'fadeUp 0.7s ease-out both',
                'fade-in':   'fadeIn 0.8s ease both',
                'scale-in':  'scaleIn 0.5s ease-out both',
                'slide-up':  'slideUp 0.6s ease-out both',
            },
            keyframes: {
                fadeUp:   { from: { opacity: '0', transform: 'translateY(30px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                fadeIn:   { from: { opacity: '0' }, to: { opacity: '1' } },
                scaleIn:  { from: { opacity: '0', transform: 'scale(0.96)' }, to: { opacity: '1', transform: 'scale(1)' } },
                slideUp:  { from: { opacity: '0', transform: 'translateY(20px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
            },
            boxShadow: {
                'soft': '0 2px 20px -4px rgba(0,0,0,0.06)',
                'card': '0 4px 30px -6px rgba(0,0,0,0.08)',
                'elevated': '0 10px 50px -10px rgba(0,0,0,0.12)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
                '4xl': '2rem',
            },
        },
    },

    plugins: [],
};

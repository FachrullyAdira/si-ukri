/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    green: '#0A6B39',
                    darkgreen: '#054F2A',
                    lightgreen: '#E8F5E9',
                    red: '#EF3829',
                    darkred: '#D32F2F',
                    gold: '#D97706',
                    amber: '#F59E0B',
                    navy: '#0F172A',
                    darknavy: '#020617',
                    lightbg: '#F8FAFC',
                    surface: '#FFFFFF',
                    slate: '#1E293B',
                    muted: '#64748B',
                },
            },
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
                inter: ['Inter', 'sans-serif'],
            },
        },
    },
    plugins: [],
};

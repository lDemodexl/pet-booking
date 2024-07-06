/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",    
  ],
  theme: {
    extend: {
      keyframes: {
        slide_in: {
          '0%': { transform: 'translateX(100%)'},
          '100%': { transform: 'translateX(0%)'},
        },
        slide_out: {
          '0%': { transform: 'translateX(0%)'},
          '100%': { transform: 'translateX(100%)'},
        },
        fade_in:{
          '0%': { opacity: '0%', transform: 'translateX(100%)'},
          '1%': { transform: 'translateX(0)'},
          '60%': { opacity: '75%'},
        },
        fade_out:{
          '0%': { opacity: '75%', transform: 'translateX(0%)'},
          '99%': { opacity: '0%' },
          '100%': { transform: 'translateX(100%)'},
        }
      },
      animation: {
        slide_in: 'slide_in 0.6s ease-in-out both',
        slide_out: 'slide_out 0.6s ease-in-out both',
        fade_in: 'fade_in 0.3s ease-in-out both',
        fade_out: 'fade_out 0.8s ease-in-out both'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}


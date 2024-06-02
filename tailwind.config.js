import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["ui-serif", "Montserrat", defaultTheme.fontFamily.sans],
            },
            fontSize: {
                sm: "0.8rem",
                base: "1rem",
                xl: "1.25rem",
                "2xl": "1.563rem",
                "3xl": "1.953rem",
                "4xl": "2.441rem",
                "5xl": "3.052rem",
            },

            colors: {
                beige: "#EDE6CA",
                orange: "#F45531",
                orangehv: "#fa7b5f",
                brown: "#443842",
                brownhv: "#66525a",
                whitebg: "#FBF9E3",
                softbrown: "#C28955",
                softbrownhv: "#edb785",
                maroon: "#C25B3A",
                maroonhv: "#e67d5c",
                burgundy: "#60212E",
                burgundyhv: "#7a3745",
                lightorange: "#E68C3A",
                lightorangehv: "#db9b60",
            },
        },
    },

    plugins: [forms],
};

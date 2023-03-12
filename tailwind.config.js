module.exports = {
  theme: {
    screens: {
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
    },
    extend: {
      colors: {
        floode: {
          primary: {
            200: "#AEB9F2",
            500: "#908DF2",
          },
          secondary: {
            100: "#BDD9F2",
            200: "#72C1F2",
            300: "#328BD9",
          },
          warning: {
            500: "#F27C38",
          },
          lighten: "#F0F2F2",
          "primary-grey": "#A7BDD9",
          "ocean-blue": {
            300: "#88AABF",
            200: "#A0DBF2",
            900: "#1A2E40",
          },
        },
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};

const primaryColors = require("@left4code/tw-starter/dist/js/colors");

module.exports = {
    content: [
        "./resources/**/*.{php,html,js,jsx,ts,tsx,vue}",
        "./node_modules/@left4code/tw-starter/**/*.js",
        ".//.html",
    ],
    darkMode: "class",
    theme: {
        borderColor: (theme) => ({
            ...theme("colors"),
            DEFAULT: primaryColors.gray["300"],
        }),
        extend: {
            colors: {
                ...primaryColors,
                primary: {
                    ...primaryColors.primary,
                    1: "#8b5cf6",
                },
                dark:{
                    ...primaryColors.dark,
                    8:"#312e81"
                },
                white: "white",
                black: "black",
                current: "current",
                transparent: "transparent",
                theme: {
                    1: "#312e81",
                    2: "#f5f3ff",
                    3: "#4c1d95",
                    4: "#eef2ff",
                    5: "#a855f7",
                    6: "#4c1d95",
                    7: "#cbd5e1",
                    8: "#581c87",
                    9: "#701a75",
                    10: "#faf5ff",
                    11: "#c084fc",
                    12: "#a5f3fc",
                    13: "#cffafe",
                    14: "#ddd6fe",
                    15: "#facc15",
                    16: "#f43f5e",
                    17: "#ECFEFF",
                    18: "#fefce8",
                    19: "#f0f9ff",
                    20: "#84cc16",
                    21: "#be123c",
                    22: "#7e22ce",
                    23: "#D6E1F5",
                    24: "#a78bfa",
                    25: "#c026d3",
                    26: "#c084fc",
                    27: "#9333ea",
                    28: "#e879f9",
                    29: "#f97316",
                    30: "#6b21a8",
                    31: "#FDF4FF",
                    32: "#f3e8ff",
                    33: "#f0abfc",
                    34: "#e9d5ff",
                    35: "#a21caf",
                    36: "#86198f",
                },
            },
            spacing: {
                "80vh": "80vh",
                "90vh": "90vh",
            },
            fontFamily: {
                roboto: ["Roboto"],
            },
            container: {
                center: true,
            },
            maxWidth: {
                "1/4": "25%",
                "1/2": "50%",
                "3/4": "75%",
            },
            strokeWidth: {
                0.5: 0.5,
                1.5: 1.5,
                2.5: 2.5,
            },
        },
    },
    variants: {
        extend: {
            boxShadow: ["dark"],
        },
    },
};

const multiplier = {
    none: 1, // Fontsize 1px - 11px
    md: 0.9, // Fontsize 12px - 17px
    lg: 0.8, // Fontsize 18px - 30px
    xl: 0.7, // Fontsize 31px - 50px
    xxl: 0.6, // Fontsize > 50px - 60px
    xxxl: 0.5, // Fontsize > 61px
};

// name: '50_54', fontSize: 50, lineHeight: 54, multiplier: multiplier.xl //// Uses multiplier on font
// name: '60_64_32_32', fontSize: 60, lineHeight: 64, multiplier: null, fontSizeMob: 32, lineHeightMob: 32 //// Uses mobile font sizes as minimum

const fontSizesList = [
    { name: '40_48', fontSize: 40, lineHeight: 48, multiplier: multiplier.xl},
    { name: "default", fontSize: 18, lineHeight: 30, multiplier: null, fontSizeMob: 13, lineHeightMob: 24, },
];

module.exports = {
    content: ["./dio.templates/tpl/**/*.tpl"],
    theme: {
        screens: {
            xl: "1107px",
            lg: { max: "1106px" },
            md: { max: "900px" },
            sm: { max: "768px" },
            mob: { max: "600px" },
            xs: { max: "500px" },
        },

        extend: {
            colors: {
                primary: "#000000",
                beige: "#F4E9DC",
                blue: "#4AAED8",
            },
            boxShadow: {
                nav: "0px 1px 12px rgba(0, 0, 0, 0.12)",
            },
            container: {
                center: true,
            },
            fontSize: loadFontSizes(fontSizesList),
        },
    },
    plugins: [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
    ],
};

function loadFontSizes(fontList) {
    var response = {};
    fontList.forEach((element) => {
        response[element.name] = fontClamp(
            element.fontSize,
            element.lineHeight,
            element.multiplier,
            element.fontSizeMob,
            element.lineHeightMob
        );
    });

    return response;
}

function fontClamp(
    fontsize,
    lineheight,
    multiplier = null,
    fontsizeMob = 0,
    lineheightMob = 0
) {
    var useMultiplier = multiplier != null ? multiplier : 1;
    var useFontSize = fontsize;
    var useFontSizeMob =
        fontsizeMob > 0 ? fontsizeMob : useFontSize * useMultiplier;
    var useLineHeight = lineheight;
    var useLineHeightMob =
        lineheightMob > 0 ? lineheightMob : useLineHeight * useMultiplier;

    return [
        `clamp(${useFontSizeMob}px, calc(${useFontSizeMob}px + ((${fontsize} - ${useFontSizeMob}) * ((100vw - 360px) / (1230 - 360)))), ${useFontSize}px)`,
        {
            lineHeight: `clamp(${useLineHeightMob}px, calc(${useLineHeightMob}px + ((${lineheight} - ${useLineHeightMob}) * ((100vw - 360px) / (1230 - 360)))), ${useLineHeight}px)`,
        },
    ];
}

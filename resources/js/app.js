// cambio de tema dark/light


const themeKey = 'theme';

function applyTheme(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
}

const savedTheme = localStorage.getItem(themeKey);

if (savedTheme === 'dark' || savedTheme === 'light') {
    applyTheme(savedTheme);
} else {
    applyTheme(
        window.matchMedia('(prefers-color-scheme: dark)').matches
            ? 'dark'
            : 'light'
    );
}

window.setTheme = function (theme) {
    if (theme !== 'dark' && theme !== 'light') {
        return;
    }

    localStorage.setItem(themeKey, theme);
    applyTheme(theme);
};

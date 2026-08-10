(function () {
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark");
    }
})();

function toggleTheme() {
    const html = document.documentElement;

    const isDark = html.classList.contains("dark");

    if (isDark) {
        html.classList.remove("dark");
        localStorage.setItem("theme", "light");
    } else {
        html.classList.add("dark");
        localStorage.setItem("theme", "dark");
    }

    updateThemeIcon();
}

function updateThemeIcon() {
    const isDark = document.documentElement.classList.contains("dark");

    const sunIcon = document.getElementById("sunIcon");
    const moonIcon = document.getElementById("moonIcon");

    if (sunIcon) {
        sunIcon.classList.toggle("hidden", !isDark);
    }

    if (moonIcon) {
        moonIcon.classList.toggle("hidden", isDark);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    updateThemeIcon();
});

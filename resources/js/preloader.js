document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }
});

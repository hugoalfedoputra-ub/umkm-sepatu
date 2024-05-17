const sidebar = document.querySelector(".sidebar");
const openSidebar = document.querySelector(".open-sidebar");
const closeSidebar = document.querySelector(".close-sidebar");

openSidebar.addEventListener("click", () => {
    sidebar.classList.add("open");
});

closeSidebar.addEventListener("click", () => {
    sidebar.classList.remove("open");
});

// Fungsi untuk menutup sidebar saat diklik di luar area sidebar
document.addEventListener("click", (event) => {
    if (
        !sidebar.contains(event.target) &&
        !openSidebar.contains(event.target)
    ) {
        sidebar.classList.remove("open");
    }
});

import 'bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("sidebarToggle");
    const sidebar = document.querySelector(".sidebar");
    const content = document.querySelector(".col-md-9");

    toggleButton.addEventListener("click", function () {
        sidebar.classList.toggle("d-none"); // Sembunyikan atau tampilkan sidebar
        content.classList.toggle("col-md-12"); // Perluas konten jika sidebar disembunyikan
        content.classList.toggle("col-md-9"); // Kembalikan ukuran konten jika sidebar ditampilkan
    });
});

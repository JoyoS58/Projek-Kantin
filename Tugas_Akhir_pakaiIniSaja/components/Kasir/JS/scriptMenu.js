const navBar = document.querySelector("nav"),
  menuBtns = document.querySelectorAll(".menu-icon"),
  overlay = document.querySelector(".overlay"),
  bodyContent = document.querySelector("body");

menuBtns.forEach((menuBtn) => {
  menuBtn.addEventListener("click", () => {
    navBar.classList.toggle("open");
    bodyContent.classList.toggle("full-content"); /* Tambahkan class saat sidebar dibuka/tutup */
  });
});

overlay.addEventListener("click", () => {
  navBar.classList.remove("open");
  bodyContent.classList.remove("full-content"); /* Hapus class saat overlay diklik */
});

//nav active
const activePage = window.location.pathname;
const navLinks = document.querySelectorAll(".nav-item a").forEach((link) => {
  if (link.href.includes(`${activePage}`)) {
    link.classList.add("navText-active");
  }
});

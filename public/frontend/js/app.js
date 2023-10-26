/*==================== 
active nav-link 
====================*/
const activePage = window.location.pathname;
const navLinks = document.querySelectorAll(".nav-item a").forEach((link) => {
  if (link.href.includes(`${activePage}`)) {
    link.classList.add("nav-active-link");
  }
});
// ===============================================================

/*==================== 
active sidebar-link 
====================*/
const dbLinks = document
  .querySelectorAll(".dashboard-sidebar-option a")
  .forEach((link) => {
    if (link.href.includes(`${activePage}`)) {
      link.parentElement.classList.add("db-active-link");
    }
  });
// =============================================================

/*======================= 
active sidebar-sub-link 
=======================*/
const dbSubLinks = document
  .querySelectorAll(".dashboard-sidebar-sub-option a")
  .forEach((link) => {
    if (link.href.includes(`${activePage}`)) {
      link.classList.add("db-sidebar-sub-active-link");
    }
  });
// =======================================================

/*======================= 
Sidebar submenu 
====================*/
// default menu open while in page
let submenu = document.querySelectorAll(".submenu-container");
let arrowDown = document.querySelectorAll(".down-icon");
let arrowUp = document.querySelectorAll(".up-icon");

for (let menu of submenu) {
  // console.log(menu.classList.value.includes("d-none"));
  if (!menu.classList.value.includes("d-none")) {
    for (let up of arrowUp) {
      up.classList.remove("d-none");
      up.classList.add("d-block");
    }
    for (let down of arrowDown) {
      down.classList.add("d-none");
      down.classList.remove("d-block");
    }
  }
}

// submenu onclick functionality
function sidebarSubmenuControl(e) {
  let arrowIconDown = e.querySelector(".arrow-icon-down");
  let arrowIconUp = e.querySelector(".arrow-icon-up");
  let submenuContainer = e.parentElement.querySelector(".submenu-container");
  console.log(submenuContainer.classList.value.includes("d-none"));

  if (submenuContainer.classList.value.includes("d-none")) {
    arrowIconUp.classList.remove("d-none");
    arrowIconUp.classList.add("d-block");
    arrowIconDown.classList.add("d-none");
    arrowIconDown.classList.remove("d-block");
    submenuContainer.classList.remove("d-none");
    submenuContainer.classList.add("d-block");
  } else {
    arrowIconUp.classList.remove("d-block");
    arrowIconUp.classList.add("d-none");
    arrowIconDown.classList.remove("d-none");
    arrowIconDown.classList.add("d-block");
    submenuContainer.classList.remove("d-block");
    submenuContainer.classList.add("d-none");
  }
}

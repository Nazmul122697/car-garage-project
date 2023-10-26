let isSidebarOpen = true;
function toggleSidebar() {
  const asideNav = document.getElementById("asideNavbar");
  const mainContent = document.getElementById("main-container");
  const dataTable = document.getElementById("dataTable");
  const dataTableHeader = document.querySelector(".dataTables_scrollHeadInner");
  const tableDataContent = document.querySelector(".table-content");

  if (isSidebarOpen) {
    isSidebarOpen = false;
    asideNav.classList.add("asideNavbar");
    mainContent.classList.add("main-containers");
    dataTable.classList.add("table-container");
    dataTableHeader.classList.add("dataTableHeaders");
    tableDataContent.classList.add("dataTableContent");
  } else {
    isSidebarOpen = true;
    asideNav.classList.remove("asideNavbar");
    mainContent.classList.remove("main-containers");
    dataTable.classList.remove("table-container");
    dataTableHeader.classList.remove("dataTableHeaders");
    tableDataContent.classList.remove("dataTableContent ");
  }
}

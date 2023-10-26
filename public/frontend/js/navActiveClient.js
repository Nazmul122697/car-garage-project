const overlay = document.querySelector(".nav-list .overlay");
const nav_list = document.querySelectorAll(" .nav-list ul li a");

// console.log(nav_list);
nav_list.forEach((list) => {
  list.addEventListener("mouseover", () => {
    let position = list.getBoundingClientRect();
    overlay.classList.add("actives");
    overlay.style.left = position.x + "px";
    overlay.style.top = position.y + "px";
    overlay.style.height = position.height + "px";
    overlay.style.width = position.width + "px";
  });
  list.addEventListener("mouseout", () => {
    overlay.classList.remove("actives");
  });
});

function uploadPhoto(i, d) {
  let input = document.getElementById(i);
  let display = document.getElementById(d);
  input.addEventListener("change", () => {
    if (input.files[0].name.length > 30) {
      display.innerText = input.files[0].name.slice(0, 30) + "...";
    } else {
      display.innerText = input.files[0].name;
    }
  });
}

function requiredField() {}

const requiredDocContainer = document.querySelectorAll(
  ".required-doc-container li span"
);

function uploadDocField(elm) {
  requiredDocContainer.forEach((doc) => {
    if (elm.files[0] && elm.name === doc.title) {
      doc.classList.remove("doc-uploaded-dot-default");
      doc.classList.add("doc-uploaded-dot-active");
    }

  });
}

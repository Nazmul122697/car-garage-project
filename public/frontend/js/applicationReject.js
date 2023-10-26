function rejectApplication(e) {
  const rejectForm = document.getElementById("rejectForm");
  if (e.checked) {
    rejectForm.classList.remove("d-none");
  } else {
    rejectForm.classList.add("d-none");
  }
}

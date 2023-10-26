function challan(e) {
  const bankSlip = document.getElementById("bank-slip");
  if (e.checked) {
    bankSlip.classList.add("d-none");
  } else {
    bankSlip.classList.remove("d-none");
  }
}

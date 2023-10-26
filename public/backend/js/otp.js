let digitValidate = function (e) {
  console.log(e.value);
  e.value = e.value.replace(/[^0-9]/g, "");
};

let tabChange = function (val) {
  let otp = document.querySelectorAll(".otp-field");
  if (otp[val - 1].value != "") {
    otp[val].focus();
  } else if (otp[val - 1].value == "") {
    otp[val - 2].focus();
  }
};

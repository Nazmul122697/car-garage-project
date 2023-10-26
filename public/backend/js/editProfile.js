function editProfile() {
  let editedProfile = document.querySelectorAll(".profile-edited");

  for (let profile of editedProfile) {
    if (profile.disabled) {
      profile.disabled = false;
      profile.classList.add("bg-white");
    }
  }
  document.getElementById("editBtnShow").classList.remove("d-none");
  document.querySelector(".profile-camera-icon").classList.remove("d-none");
  document.querySelector(".applicantName").classList.remove("d-none");
  document.getElementById("profile-img").removeAttribute("data-bs-target");
  document.getElementById("profile-img").removeAttribute("data-bs-toggle");
  document.getElementById("profile").classList.remove("profile-upload");
  document.querySelector(".nid_file").classList.remove("d-none");
  document.getElementById("nid_file_edit").classList.add("d-none");
  document.querySelector(".bin_file").removeAttribute("disabled");
//   data-bs-toggle="modal" data-bs-target="#showModal"
}

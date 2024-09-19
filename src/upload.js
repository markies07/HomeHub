// const uploadImg = document.getElementById("uploadImg");
// const showUpload = document.getElementById("showUpload");
// const closeIt = document.getElementById("closeIt");
// const realFileBtn = document.getElementById("fileImg[]");
// const customBtn = document.getElementById("custom-button");
// const customTxt = document.getElementById("custom-text");
// let modal = document.getElementById("modal");
// let picture = document.querySelectorAll(".picture img");
// let fullPic = document.getElementById("fullPicture");

// picture.forEach(function (img) {
//   img.onclick = function () {
//     modal.style.display = "block";
//     fullPic.src = this.src;
//   };
// });

// let close = document.getElementsByClassName("close")[0];

// close.onclick = function () {
//   modal.style.display = "none";
// };

// customBtn.addEventListener("click", function () {
//   realFileBtn.click();
// });

// realFileBtn.addEventListener("change", function () {
//   if (realFileBtn.value) {
//     customTxt.innerHTML = realFileBtn.value.match(
//       /[\/\\]([\w\d\s\.\-\(\)]+)$/
//     )[1];
//   } else {
//     customTxt.innerHTML = "No file chosen";
//   }
// });

// const fileInput = document.getElementById("fileImg[]");

// fileInput.addEventListener("change", (event) => {
//   const files = event.target.files;
//   console.log(files);

//   if (files.length > 4) {
//     alert("A maximum of 4 files are allowed");
//     fileInput.value = "";
//     return;
//   }
// });

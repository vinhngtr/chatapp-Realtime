const togglePass = document.querySelector(".showpass");
const pass = document.querySelector("#password");
// console.log(pass);
togglePass.addEventListener("click", (e) => {
  if (pass.type === "text") {
    pass.type = "password";
    togglePass.style.color = "#ccc";
  } else if (pass.type === "password") {
    pass.type = "text";
    togglePass.style.color = "black";
  }
});

// ----------------------------------

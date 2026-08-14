const pwd = document.getElementById("pwd");
const eye = document.getElementById("eye");

eye.addEventListener("click", () => {
  if (pwd.type === "password") {
    pwd.type = "text";
    eye.classList.remove("bi-eye-fill");
    eye.classList.add("bi-eye-slash-fill");
  } else {
    pwd.type = "password";
    eye.classList.remove("bi-eye-slash-fill");
    eye.classList.add("bi-eye-fill");
  }
});
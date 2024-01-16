document.addEventListener("DOMContentLoaded", function () {
  var passwordInput = document.querySelector('[name="contrasena"]');
  var togglePassword = document.getElementById("togglePassword");

  togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  });
});

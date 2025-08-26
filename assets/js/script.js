document
  .getElementById("togglePassword")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("floatingPassword");

    const iconEye = document.getElementById("iconEye");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";     
      iconEye.classList.remove("bi-eye");
      iconEye.classList.add("bi-eye-slash");
    } else {
      passwordInput.type = "password";
      iconEye.classList.remove("bi-eye-slash");
      iconEye.classList.add("bi-eye");
    }
  });

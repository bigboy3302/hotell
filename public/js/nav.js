document.addEventListener("DOMContentLoaded", function () {
  const userEmail = document.getElementById("user-email");
  const logoutForm = document.getElementById("logout-form");

  userEmail.addEventListener("click", function () {
    logoutForm.classList.toggle("hidden");
  });
});

import RegistrationForm from "./RegistrationForm.js";

document.addEventListener("DOMContentLoaded", () => {
  const registrationForm = new RegistrationForm("registrationForm", "alert");
  const form = document.getElementById("registrationForm");
  form.addEventListener("submit", (e) => {
    registrationForm.submitForm(e);
  });
});


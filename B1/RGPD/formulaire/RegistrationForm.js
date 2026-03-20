import Storage from "./Storage.js";

class RegistrationForm {
  constructor(formId, alertId) {
    this.form = document.getElementById(formId);
    this.alert = document.getElementById(alertId);
  }
  submitForm(e) {
    e.preventDefault();

    const email = this.form.email.value;
    const characterName = this.form.characterName.value;
    const password = this.form.password.value;
    const consent = this.form.consent.checked;


    if (!this.validateEmail(email)) {
      this.alert.textContent = "Veuillez entrer une adresse e-mail valide.";
      this.alert.style.color = "red";
      console.log("Email invalide");
      return;
    }

    if(!password) {
      this.alert.textContent = "Veuillez entrer un mot de passe.";
      this.alert.style.color = "red";
      console.log("Mot de passe invalide");
      return;
    }

    if (!consent) {
      this.alert.textContent = "Vous devez accepter la politique de confidentialité.";
      this.alert.style.color = "red";
      console.log("Consentement non donné");
      return;
    }

    Storage.setItem([
      ["email", email],
      ["characterName", characterName],
      ["password", password]
    ]);
    console.log("Données colléctées :", Storage.getAllItems());

    window.location.replace("Home.html");
  }
  
  
  validateEmail(email){
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  
}

export default RegistrationForm;
const express = require('express');
const app = express();

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.set("views", "./views");
app.set("view engine", "pug");


app.get("/", (req, res) => {
    res.render("")
});

app.get("/profil", (req, res) => {
    res.render("profil", { prenom: "gabriel", ville: "Paris" });
});


app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
});
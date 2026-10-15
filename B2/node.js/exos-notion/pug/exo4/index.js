const express = require('express');
const app = express();
const fs = require('fs');

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.set("views", "./views");
app.set("view engine", "pug");

app.get("/visiteur", (req, res) => {
    res.render("accueil", { name: "Gabriel", connecte: false });
});

app.get('/membre', (req, res) => {
    res.render('accueil', { name: "Gabriel", connecte: true });
});

app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
});
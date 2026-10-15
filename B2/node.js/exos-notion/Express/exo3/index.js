const express = require('express');
const app = express();

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.get('/', (req,res) => {
    res.send("Bienvenue sur Express !");
}).get('/bonjour', (req,res) => {
    res.send("Bonjour !");
}).get('/a-propos', (req,res) => {
    res.send("À propos de nous !");
}).get('/contact', (req,res) => {
    res.send("contact@gmail.com");
});

app.use((req, res) => {
    res.status(404).send("Erreur 404, page non trouvée");
});

app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
})
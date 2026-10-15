const express = require('express');
const app = express();
const fs = require('fs');

const produits = [
    { nom: "table", prix: 10 },
    { nom: "chaise", prix: 20 },
    { nom: "lit", prix: 30 },
    { nom: "bureau", prix: 40 },
];

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.set("views", "./views");
app.set("view engine", "pug");

app.get("/produits", (req, res) => {
    res.render("produits", { produits: produits });
});

app.get("/produits/:nom", (req, res) => {
    const nomProduit = req.params.nom;
    const produit = produits.find(p => p.nom === nomProduit);
    if (!produit) {
        return res.status(404).send("Produit non trouvé");
    }
    res.render("produit", { produit: produit });
});

app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
});
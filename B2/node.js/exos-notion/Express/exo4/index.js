const express = require('express');
const app = express();

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.get("/article", (req, res) => {
  res.send("Liste des articles");
});

app.post("/article", (req, res) => {
  const article = req.body;
  res.send("Article créée");
});

app.put("/article/:id", (req, res) => {
  res.send(`Article modifié`);
});

app.delete("/article/:id", (req, res) => {
  res.send(`Article supprimé`);
});

app.use((req, res) => {
    res.status(404).send("Erreur 404, page non trouvée");
});

app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
})
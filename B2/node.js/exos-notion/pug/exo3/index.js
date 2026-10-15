const express = require('express');
const app = express();
const fs = require('fs');

app.use((req, res, next) => {
    console.log(`Requête reçue : ${req.method} ${req.url}`);
    next();
});

app.set("views", "./views");

app.engine('html', (path, options, callback) => {
    fs.readFile(path, (err, data) => {
        if (err) return callback(err);
        const template = data.toString().replace('%name%', options.name);
        return callback(null, template);
    });
});

app.set("view engine", "html");

app.get("/", (req, res) => {
    res.render("index", { name: "Gabriel" });
});


app.listen(3000, () => {
    console.log("Serveur démarré sur http://localhost:3000");
});
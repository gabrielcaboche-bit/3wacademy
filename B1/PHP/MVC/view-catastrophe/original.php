<?php
// connexion directe à la base
$conn = new PDO("mysql:host=localhost;dbname=blog", "root", "");

// récupération des articles
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

// ajout d'un article si formulaire envoyé
if(isset($_POST['title'])){
    $title = $_POST['title'];
    $conn->query("INSERT INTO articles (title) VALUES ('$title')");
    echo "Article ajouté !";
}

// suppression si paramètre GET
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM articles WHERE id = $id");
    echo "Article supprimé";
}
?>

<h1>Liste des articles</h1>

<form method="POST">
    <input type="text" name="title">
    <button type="submit">Ajouter</button>
</form>

<?php foreach($result as $article): ?>
    <h2><?= $article['title'] ?></h2>
    <a href="?delete=<?= $article['id'] ?>">Supprimer</a>
<?php endforeach; ?>
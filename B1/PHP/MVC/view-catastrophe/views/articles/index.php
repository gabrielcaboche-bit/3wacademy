<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des articles</title>
</head>
<body>
    <h1>Liste des articles</h1>

    <form method="POST" action="?action=add">
        <input type="text" name="title" required>
        <button type="submit">Ajouter</button>
    </form>

    <?php foreach($articles as $article): ?>
        <article>
            <h2><?= htmlspecialchars($article['title']) ?></h2>
            <a href="?action=delete&delete=<?= $article['id'] ?>">Supprimer</a>
        </article>
    <?php endforeach; ?>
</body>
</html>

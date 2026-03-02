<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Test XSS</h1>

    <?php
    $comment['description'] = '<script>alert("Votre PC s\'auto-détruira dans 5 secondes");</script>';
    ?>

    <p>Commentaire : <?= $comment['description'] ?></p>
</body>

</html>
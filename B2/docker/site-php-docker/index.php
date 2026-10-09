<?php
$dossier = '/var/www/html/fichiers';
$fichiers = is_dir($dossier) ? scandir($dossier) : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Liste des fichiers</title>
</head>
<body>
	<ul>
		<?php foreach ($fichiers as $fichier): ?>
			<?php if ($fichier !== '.' && $fichier !== '..' && is_file($dossier . '/' . $fichier)): ?>
				<li><?= htmlspecialchars($fichier, ENT_QUOTES, 'UTF-8') ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</body>
</html>

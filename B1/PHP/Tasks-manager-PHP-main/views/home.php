<?php ob_start(); ?>
<div class="home-container">
    <h1>Gestionnaire de tâches</h1>
    <p class="home-description">Organisez vos tâches avec la matrice d'Eisenhower</p>
    
    <div class="home-actions">
        <a href="index.php?page=register" class="btn btn-primary btn-large">Inscription</a>
        <a href="index.php?page=login" class="btn btn-secondary btn-large">Connexion</a>
    </div>
</div>

<?php $content = ob_get_clean(); require 'views/layout.phtml'; ?>
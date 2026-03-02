<?php ob_start(); ?>
<h2>Inscription</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        Compte créé avec succès ! Vous pouvez maintenant vous connecter.
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe (minimum 8 caractères)</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required minlength="8">
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<p>Déjà inscrit ? <a href="index.php?page=login">Connexion</a></p>

<?php $content = ob_get_clean();
require 'views/layout.phtml'; ?>

<?php ob_start(); ?>
<h2>Modifier la tâche</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (!$task): ?>
    <div class="alert alert-error">
        Tâche non trouvée
    </div>
    <a href="index.php?page=dashboard" class="btn btn-primary">Retour au tableau de bord</a>
<?php else: ?>
    <form method="post">
        <div class="form-group">
            <label for="title">Titre de la tâche</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
        <div class="form-group">
            <label class="switch switch--urgent">
                <input type="checkbox" name="urgent" value="1" <?= $task['is_urgent'] ? 'checked' : '' ?>>
                <span class="switch-track" aria-hidden="true"></span>
                <span class="switch-label">Urgent</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch switch--important">
                <input type="checkbox" name="important" value="1" <?= $task['is_important'] ? 'checked' : '' ?>>
                <span class="switch-track" aria-hidden="true"></span>
                <span class="switch-label">Important</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch switch--done">
                <input type="checkbox" name="done" value="1" <?= $task['is_done'] ? 'checked' : '' ?>>
                <span class="switch-track" aria-hidden="true"></span>
                <span class="switch-label">Terminée</span>
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="index.php?page=dashboard" class="btn btn-secondary">Annuler</a>
    </form>
<?php endif; ?>

<?php $content = ob_get_clean();
require 'views/layout.phtml'; ?>

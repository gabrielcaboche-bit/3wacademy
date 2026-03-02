<?php ob_start(); ?>
<h2>Classement</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (empty($ranking)): ?>
    <p>Aucun classement disponible pour le moment.</p>
<?php else: ?>
    <div class="ranking-container">
        <ol class="ranking-list">
            <?php foreach ($ranking as $index => $row): ?>
                <li class="ranking-item">
                    <span class="ranking-position"><?= $index + 1 ?></span>
                    <span class="ranking-username"><?= htmlspecialchars($row['username']) ?></span>
                    <span class="ranking-total"><?= $row['total'] ?> tâche(s) terminée(s)</span>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>

<a href="index.php?page=dashboard" class="btn btn-primary">Retour au tableau de bord</a>

<?php $content = ob_get_clean();
require 'views/layout.phtml'; ?>

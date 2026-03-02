-- Script pour peupler la base de données avec des données de test
-- Exécutez ce fichier dans votre base de données MySQL

-- Nettoyer les données existantes (optionnel - décommentez si nécessaire)
-- DELETE FROM task;
-- DELETE FROM user;

-- Insérer des utilisateurs de test
INSERT INTO user (username, email, password) VALUES
('Jean Dupont', 'jean.dupont@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Marie Martin', 'marie.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Pierre Bernard', 'pierre.bernard@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sophie Leroy', 'sophie.leroy@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Lucas Moreau', 'lucas.moreau@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insérer des tâches pour Jean Dupont
-- Tâches actives
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Préparer la réunion client', 1, 1, 0, (SELECT id FROM user WHERE email = 'jean.dupont@email.com')),
('Envoyer le rapport mensuel', 1, 0, 0, (SELECT id FROM user WHERE email = 'jean.dupont@email.com')),
('Répondre aux emails', 0, 1, 0, (SELECT id FROM user WHERE email = 'jean.dupont@email.com')),
('Mettre à jour le portfolio', 0, 0, 0, (SELECT id FROM user WHERE email = 'jean.dupont@email.com'));

-- Tâches terminées pour Jean
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Finaliser le projet web', 1, 1, 1, (SELECT id FROM user WHERE email = 'jean.dupont@email.com')),
('Appeler le fournisseur', 0, 1, 1, (SELECT id FROM user WHERE email = 'jean.dupont@email.com')),
('Organiser les fichiers', 0, 0, 1, (SELECT id FROM user WHERE email = 'jean.dupont@email.com'));

-- Insérer des tâches pour Marie Martin
-- Tâches actives
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Créer le design du logo', 1, 1, 0, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Rédiger le contenu du site', 1, 0, 0, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Tester la responsive design', 0, 1, 0, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Optimiser les images', 0, 0, 0, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Configurer le SEO', 0, 1, 0, (SELECT id FROM user WHERE email = 'marie.martin@email.com'));

-- Tâches terminées pour Marie
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Analyser la concurrence', 1, 1, 1, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Définir la palette de couleurs', 0, 1, 1, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Choisir les polices', 0, 0, 1, (SELECT id FROM user WHERE email = 'marie.martin@email.com')),
('Créer le wireframe', 1, 0, 1, (SELECT id FROM user WHERE email = 'marie.martin@email.com'));

-- Insérer des tâches pour Pierre Bernard
-- Tâches actives
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Développer l\'API REST', 1, 1, 0, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com')),
('Écrire les tests unitaires', 1, 0, 0, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com')),
('Documenter le code', 0, 1, 0, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com')),
('Revoir le code legacy', 0, 0, 0, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com'));

-- Tâches terminées pour Pierre
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Configurer l\'environnement de dev', 1, 1, 1, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com')),
('Installer les dépendances', 0, 1, 1, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com')),
('Créer la structure du projet', 1, 0, 1, (SELECT id FROM user WHERE email = 'pierre.bernard@email.com'));

-- Insérer des tâches pour Sophie Leroy
-- Tâches actives
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Planifier la campagne marketing', 1, 1, 0, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Créer les visuels réseaux sociaux', 1, 0, 0, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Rédiger les articles de blog', 0, 1, 0, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Analyser les statistiques', 0, 0, 0, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Préparer la newsletter', 0, 1, 0, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com'));

-- Tâches terminées pour Sophie
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Lancer la campagne précédente', 1, 1, 1, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Créer le calendrier éditorial', 0, 1, 1, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Mettre à jour les profils sociaux', 0, 0, 1, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com')),
('Analyser les résultats Q1', 1, 0, 1, (SELECT id FROM user WHERE email = 'sophie.leroy@email.com'));

-- Insérer des tâches pour Lucas Moreau
-- Tâches actives
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Former les nouveaux employés', 1, 1, 0, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Préparer les évaluations', 1, 0, 0, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Organiser le team building', 0, 1, 0, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Mettre à jour les procédures', 0, 0, 0, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com'));

-- Tâches terminées pour Lucas
INSERT INTO task (title, is_urgent, is_important, is_done, user_id) VALUES
('Recruter un développeur', 1, 1, 1, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Créer les offres d\'emploi', 0, 1, 1, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Conduire les entretiens', 1, 0, 1, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com')),
('Intégrer les nouveaux arrivants', 0, 0, 1, (SELECT id FROM user WHERE email = 'lucas.moreau@email.com'));

-- Afficher un résumé
SELECT 'Données de test insérées avec succès!' AS message;
SELECT COUNT(*) AS nombre_utilisateurs FROM user;
SELECT user_id, COUNT(*) AS nombre_taches, SUM(is_done) AS taches_terminees FROM task GROUP BY user_id;

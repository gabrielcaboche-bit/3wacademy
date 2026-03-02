<?php
require 'models/user.php';


function register()
{
    global $pdo;
    $error = null;
    $success = null;

    if ($_POST) {
        try {
            // Validate email format
            if (!preg_match('/^[^@]+@[^@]+\.[^@]+$/', $_POST['email'])) {
                $error = "Format d'email invalide";
            }
            // Validate password length (minimum 8 characters)
            elseif (!preg_match('/.{8,}/', $_POST['password'])) {
                $error = "Le mot de passe doit contenir au moins 8 caractères";
            }
            else {
                // Check if email already exists
                $existingUser = getUserByEmail($pdo, $_POST['email']);
                if ($existingUser) {
                    $error = "Cet email est déjà utilisé";
                } else {
                    // Hash password and create user
                    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $result = createUser($pdo, $_POST['username'], $_POST['email'], $hash);

                    if ($result) {
                        $success = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
                        header('Location: index.php?page=login&success=1');
                        exit;
                    } else {
                        $error = "Erreur lors de la création du compte";
                    }
                }
            }
        } catch (PDOException $e) {
            $error = "Erreur de base de données: " . $e->getMessage();
        } catch (Exception $e) {
            $error = "Une erreur est survenue: " . $e->getMessage();
        }
    }

    require 'views/register.php';
}


function login()
{
    global $pdo;
    $error = null;

    if ($_POST) {
        try {
            $user = getUserByEmail($pdo, $_POST['email']);
            if (!$user) {
                $error = "Email ou mot de passe incorrect";
            } elseif (!password_verify($_POST['password'], $user['password'])) {
                $error = "Email ou mot de passe incorrect";
            } else {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=dashboard');
                exit;
            }
        } catch (PDOException $e) {
            $error = "Erreur de base de données: " . $e->getMessage();
        } catch (Exception $e) {
            $error = "Une erreur est survenue: " . $e->getMessage();
        }
    }

    require 'views/login.php';
}


function logout()
{
    session_destroy();
    header('Location: index.php');
    exit;
}
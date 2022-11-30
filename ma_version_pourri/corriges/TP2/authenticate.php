<?php
/******************************************************************************
 * Initialisation.
 */

session_start();
unset($_SESSION['message']);

/******************************************************************************
 * Traitement des données de la requête
 */

// 1. On vérifie que la méthode HTTP utilisée est bien POST
if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
{
    header('Location: signin.php');
    exit();
}

// 2. On vérifie que les données attendues existent
if ( !isset($_POST['login'],$_POST['password']) )
{
    header('Location: signin.php');
    exit();
}

// 3. On sécurise les données reçues
$login = htmlentities($_POST['login']);
$password = htmlentities($_POST['password']);

/******************************************************************************
 * Initialisation de l'accès à la BDD
 */

require_once('bdd.php');

/******************************************************************************
 * Authentification
 */

// 1. On vérifie que le login existe dans la BDD
if ( !array_key_exists($login, $users) )
{
    $_SESSION['message'] = "Wrong login.";
    header('Location: signin.php');
    exit();
}

// 2. On vérifie que le mot de passe associé au login est correct
if ( $users[$login] !== $password )
{
    $_SESSION['message'] = "Wrong password.";
    header('Location: signin.php');
    exit();
}

// 3. On sauvegarde le login dans la session
$_SESSION['user'] = $login;

// 4. On sollicite une redirection vers la page du compte
header('Location: account.php');
exit();

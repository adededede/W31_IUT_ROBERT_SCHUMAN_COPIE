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
	header('Location: signup.php');
	exit();
}

// 2. On vérifie que les données attendues existent
if ( empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm']) )
{
	$_SESSION['message'] = "Some POST data are missing.";
	header('Location: signup.php');
	exit();
}

// 3. On sécurise les données reçues
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);
$confirm = htmlspecialchars($_POST['confirm']);

// 4. On vérifie que les deux mots de passe correspondent
if ( $password !== $confirm )
{
	$_SESSION['message'] = "The two passwords differ.";
	header('Location: signup.php');
	exit();
}

/******************************************************************************
 * Initialisation de l'accès à la BDD
 */

try {
	require_once('bdd.php');
	$pdo = new PDO($SQL_DSN);
}
catch( PDOException $e ) {
	$_SESSION['message'] = 'PDO error : '.$e->getMessage();
	header('Location: signup.php');
	exit();
}

/******************************************************************************
 * Ajout de l'utilisateur
 */

// 1. On prépare la requête
$request = $pdo->prepare( "INSERT INTO Users(login,password) VALUES (:login,:password)" );

// 2. On assigne les paramètres nommés
$ok  = $request->bindValue( ":login",	$login,	PDO::PARAM_STR );
$ok &= $request->bindValue( ":password", password_hash($password,PASSWORD_DEFAULT), PDO::PARAM_STR );

// 3. On exécute la requête
$ok &= $request->execute();

// 4. On vérifie que la requête s'est executée sans erreur
if ( !$ok )
{
	$_SESSION['message'] = "Account creation error, try again.";
	header('Location: signup.php');
	exit();
}

// 5. On indique que le compte a bien été créé
$_SESSION['message'] = "Account created! Now, signin.";

// 6. On sollicite une redirection vers la page d'accueil
header('Location: signin.php');
exit();

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
if ( empty($_POST['login']) || empty($_POST['password']) )
{
	$_SESSION['message'] = "Some POST data are missing.";
	header('Location: signin.php');
	exit();
}

// 3. On sécurise les données reçues
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

/******************************************************************************
 * Initialisation de l'accès à la BDD
 */

try {
	require_once('bdd.php');
	$pdo = new PDO($SQL_DSN);
}
catch( PDOException $e ) {
	$_SESSION['message'] = 'BDD error : '.$e->getMessage();
	header('Location: signin.php');
	exit();
}

/******************************************************************************
 * Authentification
 */

// 1. On prépare la requête
$request = $pdo->prepare( "SELECT password FROM Users WHERE login = :login" );

// 2. On assigne les paramètres nommés
$ok = $request->bindValue( ":login", $login, PDO::PARAM_STR );

// 3. On exécute la requête
$ok &= $request->execute();

// 4. On vérifie que la requête s'est executée sans erreur
if ( !$ok )
{
	$_SESSION['message'] = "Error during execute().";
	header('Location: signin.php');
	exit();
}

// 5. On récupère la 1ère ligne du résultat de la requête
$user = $request->fetch();

// 6. On vérifie que l'utilisateur a été trouvé
if ( !$user )
{
	$_SESSION['message'] = "Wrong login.";
	header('Location: signin.php');
	exit();
}

// 7. On vérifie que le mot de passe de la BBD correspond
// au mot de passe transmis en POST
if ( !password_verify($password,$user['password']) )
{
	$_SESSION['message'] = "Wrong password.";
	header('Location: signin.php');
	exit();
}

// 8. On sauvegarde le login dans la session
$_SESSION['user'] = $login;

// 9. On sollicite une redirection vers la page du compte
header('Location: account.php');
exit();

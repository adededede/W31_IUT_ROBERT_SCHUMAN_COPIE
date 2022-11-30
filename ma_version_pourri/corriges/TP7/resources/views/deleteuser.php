<?php
/******************************************************************************
 * Initialisation.
 */
unset($_SESSION['message']);

/******************************************************************************
 * Vérification de la session
 */

// 2. On récupère le login dans une variable
$login = $_SESSION['user'];

/******************************************************************************
 * Chargement du model
 */

use \App\Models\MyUser;

/******************************************************************************
 * Suppression de l'utilisateur
 */

// 1. On crée l'utilisateur avec les identifiants passés en POST
$user = new MyUser($login);

// 2. On détruit l'utilisateur dans la BDD
try {
	$user->delete();
}
catch (PDOException $e) {
	// Si erreur lors de la création de l'objet PDO
	// (déclenchée par MyPDO::pdo())
	$_SESSION['message'] = $e->getMessage();
	header('Location: admin/account');
	exit();
}
catch (Exception $e) {
	// Si erreur durant l'exécution de la requête
	// (déclenchée par le throw de $user->create())
	$_SESSION['message'] = $e->getMessage();
	header('Location: admin/account');
	exit();
}

// 3. On détruit la session
session_destroy();

// 4. On crée une nouvelle session
session_start();

// 5. On indique que le compte a bien été supprimé
$_SESSION['message'] = "Account successfully deleted.";

// 4. On sollicite une redirection vers la page d'authentification
header('Location: /signin');
exit();

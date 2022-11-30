<?php
/******************************************************************************
 * Initialisation.
 */
unset($_SESSION['message']);

/******************************************************************************
 * Traitement des données de la requête
 */

// 2. On vérifie que les données attendues existent
if ( empty($_POST['where']) || empty($_POST['species']) || empty($_POST['scName']) || empty($_POST['description']))
{
	$_SESSION['message'] = "Some POST data are missing.";
	header('Location: /account');
	exit();
}

// 3. On sécurise les données reçues
$where = htmlspecialchars($_POST['where']);
$species = htmlspecialchars($_POST['species']);
$scName = htmlspecialchars($_POST['scName']);
$description = htmlspecialchars($_POST['description']);



/******************************************************************************
 * Chargement du model
 */

use \App\Models\MyBird;

/******************************************************************************
 * Ajout de l'utilisateur
 */

// 1. On crée l'observation d'oiseau avec les identifiants passés en POST
$user = new MyBird($where,$species,$scName,$description);

// 2. On crée l'oiseau dans la BDD
try {
	$user->create();
}
catch (PDOException $e) {
	// Si erreur lors de la création de l'objet PDO
	// (déclenchée par MyPDO::pdo())
	$_SESSION['message'] = $e->getMessage();
	header('Location: /account');
	exit();
}
catch (Exception $e) {
	// Si erreur durant l'exécution de la requête
	// (déclenchée par le throw de $user->create())
	$_SESSION['message'] = $e->getMessage();
	header('Location: /account');
	exit();
}

// 3. On indique que le compte a bien été créé
$_SESSION['message'] = "Bird's observation created!";

// 4. On sollicite une redirection vers la page d'accueil
header('Location: /account');
exit();

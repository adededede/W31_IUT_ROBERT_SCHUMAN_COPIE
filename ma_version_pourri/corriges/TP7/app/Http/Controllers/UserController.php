<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyUser;

class UserController extends Controller
{
	/**
	 * Show the signin page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function signin( Request $request )
	{
		return view('signin',['message' => $request->session()->get('message')]);
	}

	/**
	 * Show the signup page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function signup( Request $request )
	{
		return view('signup',['message' => $request->session()->get('message')]);
	}

	/**
	 * Show the formpassword page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function formpassword( Request $request )
	{
		return view('formpassword',['message' => $request->session()->get('message')]);
	}

	/**
	 * Signout
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function signout( Request $request )
	{
		$request->session()->flush();
		return redirect()->route('signin');
	}

	/**
	 * Show the account page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function account( Request $request )
	{
		return view('account', [
			'user' => $request->session()->get('user'),
			'message',$request->session()->get('message')
		]);
	}

	/**
	 * Authentication
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function authenticate( Request $request )
	{
		/******************************************************************************
		 * Traitement des données de la requête
		 */

		// 2. On vérifie que les données attendues existent
		if ( !$request->filled(['login','password']) )
			return redirect()->route('signin')->with('message','Some POST data are missing.');

		/******************************************************************************
		 * Authentification
		 */

		// 1. On crée l'utilisateur avec les identifiants passés en POST
		$user = new MyUser($request->login,$request->password);

		// 2. On vérifie qu'il existe dans la BDD
		try
		{
			if ( !$user->exists() )
				return redirect()->route('signin')->with('message','Wrong login/password.');
		}
		catch (\PDOException $e) {
			// Si erreur lors de la création de l'objet PDO
			// (déclenchée par MyPDO::pdo())
			return redirect()->route('signin')->with('message',$e->getMessage());
		}
		catch (\Exception $e) {
			// Si erreur durant l'exécution de la requête
			// (déclenchée par le throw de $user->exists())
			return redirect()->route('signin')->with('message',$e->getMessage());
		}

		// 3. On sauvegarde le login dans la session
		$request->session()->put('user',$request->login);

		// 4. On sollicite une redirection vers la page du compte
		return redirect()->route('account');
	}


	/**
	 * Add a user
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function addUser( Request $request )
	{
		/******************************************************************************
		 * Traitement des données de la requête
		 */

		// 2. On vérifie que les données attendues existent
		if ( !$request->filled(['login','password','confirm']) )
			return redirect()->route('signup')->with('message','Some POST data are missing.');

		// 4. On vérifie que les deux mots de passe correspondent
		if ( $request->password !== $request->confirm )
			return redirect()->route('signup')->with('message','The two passwords differ.');

		/******************************************************************************
		 * Ajout de l'utilisateur
		 */

		// 1. On crée l'utilisateur avec les identifiants passés en POST
		$user = new MyUser($request->login,$request->password);

		// 2. On crée l'utilisateur dans la BDD
		try
		{
			$user->create();
		}
		catch (\PDOException $e) {
			// Si erreur lors de la création de l'objet PDO
			// (déclenchée par MyPDO::pdo())
			return redirect()->route('signup')->with('message',$e->getMessage());
		}
		catch (\Exception $e) {
			// Si erreur durant l'exécution de la requête
			// (déclenchée par le throw de $user->create())
			return redirect()->route('signup')->with('message',$e->getMessage());
		}

		// 3. On indique que le compte a bien été créé
		// 4. On sollicite une redirection vers la page d'accueil
		return redirect()->route('signin')->with('message','Account created! Now, signin.');
	}

	/**
	 * Change the user password
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function changePassword( Request $request )
	{
		/******************************************************************************
		 * Vérification de la session
		 */

		// 2. On récupère le login dans une variable
		$login = $request->session()->get('user');

		/******************************************************************************
		 * Traitement des données de la requête
		 */

		// 2. On vérifie que les données attendues existent
		if ( !$request->filled(['newpassword','confirmpassword']) )
			return redirect()->route('formpassword')->with('message','Some POST data are missing.');

		// 4. On s'assure que les 2 mots de passes sont identiques
		if ( $request->newpassword != $request->confirmpassword )
			return redirect()->route('formpassword')->with('message','Error: passwords are different.');

		/******************************************************************************
		 * Changement du mot de passe
		 */

		// 1. On crée l'utilisateur avec les identifiants passés en POST
		$user = new MyUser($login);

		// 2. On change le mot de passe de l'utilisateur
		try {
			$user->changePassword($request->newpassword);
		}
		catch (\PDOException $e) {
			// Si erreur lors de la création de l'objet PDO
			// (déclenchée par MyPDO::pdo())
			return redirect()->route('formpassword')->with('message',$e->getMessage());
		}
		catch (\Exception $e) {
			// Si erreur durant l'exécution de la requête
			// (déclenchée par le throw de $user->changePassword())
			return redirect()->route('formpassword')->with('message',$e->getMessage());
		}

		// 3. On indique que le mot de passe a bien été modifié
		// 4. On sollicite une redirection vers la page du compte
		return redirect()->route('account')->with('message','Password successfully updated.');
	}

	/**
	 * Delete the logged user
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function deleteUser( Request $request )
	{
		/******************************************************************************
		 * Vérification de la session
		 */

		// 2. On récupère le login dans une variable
		$login = $request->session()->get('user');

		/******************************************************************************
		 * Suppression de l'utilisateur
		 */

		// 1. On crée l'utilisateur avec les identifiants passés en POST
		$user = new MyUser($login);

		// 2. On détruit l'utilisateur dans la BDD
		try {
			$user->delete();
		}
		catch (\PDOException $e) {
			// Si erreur lors de la création de l'objet PDO
			// (déclenchée par MyPDO::pdo())
			return redirect()->route('account')->with('message',$e->getMessage());
		}
		catch (\Exception $e) {
			// Si erreur durant l'exécution de la requête
			// (déclenchée par le throw de $user->create())
			return redirect()->route('account')->with('message',$e->getMessage());
		}

		// 3. On détruit la session
		$request->session()->flush();

		// 4. On crée une nouvelle session
		// 5. On indique que le compte a bien été supprimé
		// 4. On sollicite une redirection vers la page d'authentification
		return redirect()->route('signin')->with('message','Account successfully deleted.');
	}
}

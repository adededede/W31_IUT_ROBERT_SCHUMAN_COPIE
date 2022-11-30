<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use PDO;

class MyBird
{
	private string $_login;
	private ?string $_password;

	private const BIRDS_TABLE = "Birds";

	public function __construct( string $where, string $species, string $scName,string $description)
	{
		$this->setLocation($where);
		$this->setSpecies($species);
		$this->setName($scName);
		$this->setLastName($description);
	}

  public function login() : string{
    return $request->session()->get('user')->id;
  }

	public function location() : string
	{
		return $this->_where;
	}

	public function setLocation( string $where ) : void
	{
		$this->_where = $where;
	}

	public function species() : string
	{
		return $this->_species;
	}

	public function setSpecies( ?string $species ) : void
	{
		$this->_species = $species;
	}

	public function scName() : string
	{
		return $this->_scName;
	}

	public function setScName( string $scName ) : void
	{
		$this->_scName = $scName;
	}

	public function description() : string
	{
		return $this->_description;
	}

	public function setDescription(string $description ) : void
	{
		$this->_description = $description;
	}



	public function exists() : bool
	{
		// 1. On prépare la requête $request
		$request = DB::connection()->getPdo()->prepare('SELECT password FROM '.self::BIRDS_TABLE.' WHERE login = :login');
		// 2. On assigne $login au paramêtre :login
		$ok = $request->bindValue( ":login", $this->_login, PDO::PARAM_STR );
		// 3. On exécute la requête $request
		$ok &= $request->execute();

		if (!$ok)
			throw new Exception("Error: user access in DB failed.");

		// 4. On vérifie que l'utilisateur a été trouvé et que son mot de passe
		//    correspond à celui de l'attribut $this->_password
		$user = $request->fetch(PDO::FETCH_ASSOC);
		return $user && password_verify($this->_password,$user['password']);
	}

	public function create() : void
	{
		$request = DB::connection()->getPdo()->prepare('INSERT INTO '.self::BIRDS_TABLE.'(login,password,name,lastname) VALUES (:login,:password,:name,:lastname)');
		$ok =  $request->bindValue( ":where", $this->_where, PDO::PARAM_STR );
		$ok &= $request->bindValue( ":login", $this->_login, PDO::PARAM_STR );
		$ok &= $request->bindValue( ":name", $this->_name, PDO::PARAM_STR );
		$ok &= $request->bindValue( ":lastname", $this->_lastname, PDO::PARAM_STR );
		$ok &= $request->execute();

		if ( !$ok )
			throw new Exception("Error: user creation in DB failed.");
	}
}

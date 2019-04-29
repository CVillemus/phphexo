<?php

// Singleton qui permet de rendre une instance PDO disponible globalement.
class DatabaseConnexion{
	protected static $singleton;

	protected function __construct(){
		
	}

	public static function connect($dsn, $dbUser, $dbPassword){
		try {
		    $connexion = new PDO($dsn, $dbUser, $dbPassword);
		    $connexion->exec('SET NAMES utf8');
		    self::$singleton = $connexion;
		} catch (PDOException $e) {
		    print "Erreur: " . $e->getMessage();
		    exit();
		}
	}

	public static function get(){
		return self::$singleton;
	}
}



function insertUserMail($data){
	if(!empty($data["lastname"]) 
	&& !empty($data["firstname"])
	&& !empty($data["email"])
	){
            $currentTime = date("Y-m-d H:i:s");

		$connexion = DatabaseConnexion::get();
		$sql = "INSERT INTO newsletter(newsletter_lastname, newsletter_firstname, newsletter_mail, newsletter_date) 
		VALUES(:lastname, :firstname, :email, :date)";
		$prepared = $connexion->prepare($sql);
		$prepared->bindValue(":lastname", strip_tags($data["lastname"]));
		$prepared->bindValue(":firstname", strip_tags($data["firstname"]));
            $prepared->bindValue(":email", strip_tags($data["email"]));
            
            $prepared->bindValue(":date", $currentTime);
		return $prepared->execute();
	}else{
		return false;
	}
}



// Cherche un utilisateur sur base de la colonne login
function getUserWithLogin($login){
	$connexion = DatabaseConnexion::get();
	$sql = "SELECT * FROM admin
	WHERE admin_username = :login 
	LIMIT 1";
	$adminPrep = $connexion->prepare($sql);
	$adminPrep -> bindValue("login", $login);
	$adminPrep -> execute();
	$user = $prepared -> fetch();
	return $user;
}

// Cherche un utilisateur sur base de la colonne secret
function getUserWithSecret($secret){
	$connexion = DatabaseConnexion::get();
	$sql = "SELECT * FROM admin 
	WHERE admin_secret = :secret 
	LIMIT 1";
	$secretPrepare = $connexion->prepare($sql);
	$secretPrepare -> bindValue("secret", $secret);
	$secretPrepare -> execute();
	$user = $prepared-> fetch();
	return $user;
}

// Connecte un utilisateur sur base de son login et mot de passe
function connectUser($login, $password){
	// $user = getUserWithLogin($login);
	// if(!empty($user && password_verify($password, $user['hash']))){
	// 	$_SESSION['user_secret'] = $user['secret'];
	// 	return true;
	// }else{
	// 	return false;
	// }
}

// Déconnecte l'utilisateur
function disconnectUser(){
	$_SESSION['user_secret'] = null;
}

// Retourne l'utilisateur connecté 
function getConnectedUser(){
	// this method is only safe because we use session.
	if(!empty($_SESSION['user_secret'])){
		return getUserWithSecret($_SESSION['user_secret']);
	}
}

// Redirige vers une url et arrête l'execution du script
function redirectTo($url){
	header("Location: ".$url);
	exit;
}

// Vérifie si un utilisateur est connecté.
// Si ce n'est pas le cas, on redirige vers la page de login
function secure(){
	$user = getConnectedUser();
	if(empty($user)){
		redirectTo("login.php");
	}
}

// Initialisation de l'app
$dsn = 'mysql:host=localhost;dbname=phptfe';
$dbUser = 'root';
$dbPassword = 'root';
DatabaseConnexion::connect($dsn, $dbUser, $dbPassword);
session_start();


<?php
/**
* Fichier de Modele
*/
if (file_exists('base.php')){
    include_once 'base.php';
}
else {
    include_once '../base.php';
}
/**
* Classe permettant d'accéder à la table acces de la base de donnée
* La table acces définit les différents niveaux d'acces du site
*/
class acces
{
	/**
    * identifiant du niveau d'acces
    * @access private
    *  @var integer
    */
    private $ida;

    /**
    * nom du niveau d'acces
    * @access private
    *  @var string
    */
    private $nom;
	
	public function __construct() {
    	
  	}

	// Focntion de getter
  	public function __get($attr_name) {
    	if (property_exists( __CLASS__, $attr_name)) {
      		return $this->$attr_name;
    	}
    	$emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
    	throw new Exception($emess, 45);
  	}

	// Fonction de setter
  	public function __set($attr_name, $attr_val) {
   		if (property_exists( __CLASS__, $attr_name)) {
      		$this->$attr_name = $attr_val;
    	}
    	$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    }
	
	public function insertAcces($nom) {
		$c = Base::getConnection();
		$query = $c->prepare("INSERT INTO acces (nom) VALUES (:nom)");
		$query->bindParam(':nom', $nom, PDO::PARAM_STR);
		$query->execute();
		return $c->lastInsertId('acces');
	}
	
	public function updateAcces($ida, $nom) {
		$c = Base::getConnection();
		$query = $c->prepare("UPDATE acces SET nom = :nom WHERE ida = :ida");
		$query->bindParam(':nom', $nom, PDO::PARAM_STR);
		$query->bindParam(':ida', $ida, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}
	
	public function getAccesById($ida) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM acces WHERE ida = :ida");
		$query->bindParam(':ida', $ida, PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}
	
	public function getAccesByNom($nom) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM acces WHERE nom = :nom");
		$query->bindParam(':nom', $nom, PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}
	
	// Fonction qui retourne la listes des niveaux d'accès
	public function getAllAcces(){
		$c = Base::getConnection();
        $query = $c->prepare("select * from acces");
        $query->execute();
        return $query->fetchAll();
	}
	
	public function deleteAcces($ida) {
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM acces WHERE ida = :ida");
		$query->bindParam(':ida', $ida, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}
}
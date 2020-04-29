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
* Classe permettant d'accéder à la table niveau de la base de donnée
* La table niveau permet de définir les différents critères de diner pouvant être assignés (1 seul par diner)
*/
class niveau {

    private $idl;
	private $nom;

    public function __construct() {
        
    }

	// Fonction de getter
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
	
	// Fonction permettant d'ajouter un nouveau critère dans la base
	public function insertNiveau($nom){
		$c = Base::getConnection();
		$query = $c->prepare("insert into niveau (nom) values (:nom)");
		$query->bindParam (':nom',$nom, PDO::PARAM_STR);
		$query->execute();
	}

	public function getNiveauById($idl) {
		$c = Base::getConnection();
        $query = $c->query('SELECT * FROM niveau WHERE idl ='.$idl);
        return $query->fetch();
	}

	// Fonction qui retourne la liste des niveaus
    public function getAllNiveaux(){
        $c = Base::getConnection();
        $query = $c->prepare("select * from niveau");;
        $dbres = $query->execute();
        return $query->fetchAll();
    }
	
	public function deleteNiveau($idl) {
		//Modifier le niveau des users
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM niveau WHERE idl = :idl");
		$query->bindParam(':idl', $idl, PDO::PARAM_INT);
		$query->execute();
	}
}
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
* Classe permettant d'accéder à la table typeGrimpe de la base de donnée
* La table typeGrimpe permet de définir les différents critères de diner pouvant être assignés (1 seul par diner)
*/
class typeGrimpe {

    private $idt;
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
	public function insertTypeGrimpe($nom){
		$c = Base::getConnection();
		$query = $c->prepare("insert into typegrimpe (nom) values (:nom)");
		$query->bindParam (':nom',$nom, PDO::PARAM_STR);
		$query->execute();
		return $c->lastInsertId('typegrimpe');
	}
	
	public function updateTypeGrimpe($idt, $nom) {
		$c = Base::getConnection();
		$query = $c->prepare("UPDATE typegrimpe SET nom = :nom WHERE idt = :idt");
		$query->bindParam(':nom', $nom, PDO::PARAM_STR);
		$query->bindParam(':idt', $idt, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}

	public function getTypeGrimpeById($idt) {
		$c = Base::getConnection();
        $query = $c->query('SELECT * FROM typegrimpe WHERE idt ='.$idt);
        return $query->fetch();
	}

	// Fonction qui retourne la liste des typeGrimpes
    public function getAllTypeGrimpe(){
        $c = Base::getConnection();
        $query = $c->prepare("select * from typegrimpe");;
        $dbres = $query->execute();
        return $query->fetchAll();
    }
	
	public function deleteTypeGrimpe($idt) {
		//Modifier le typeGrimpe des users
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM typegrimpe WHERE idt = :idt");
		$query->bindParam(':idt', $idt, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}
}
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
* Classe permettant d'accéder à la table critere de la base de donnée
* La table critere permet de définir les différents critères de diner pouvant être assignés (1 seul par diner)
*/
class critere {

	/**
    * identifiant du critere
    * @access private
    *  @var integer
    */
    private $idc;

	/**
    * nom du critere
    * @access private
    *  @var string
    */
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
	public function insertCritere($nom){
		$c = Base::getConnection();
		$query = $c->prepare("insert into critere (nom) values (:nom)");
		$query->bindParam (':nom',$nom, PDO::PARAM_STR);
		$query->execute();
		return $c->lastInsertId('critere');
	}
	
	public function updateCritere($idc, $nom) {
		$c = Base::getConnection();
		$query = $c->prepare("UPDATE critere SET nom = :nom WHERE idc = :idc");
		$query->bindParam(':nom', $nom, PDO::PARAM_STR);
		$query->bindParam(':idc', $idc, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}

	public function getCritereById($idc) {
		$c = Base::getConnection();
        $query = $c->query('SELECT * FROM critere WHERE idc ='.$idc);
        return $query->fetch();;
	}

	// Fonction qui retourne la liste des criteres
    public function getAllCriteres(){
        $c = Base::getConnection();
        $query = $c->prepare("select * from critere");
        $query->execute();
		return $query->fetchAll();
    }
	
	public function deleteCritere($idc) {
		// Modifier les destinations
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM critere WHERE idc = :idc");
		$query->bindParam(':idc', $idc, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
	}
}
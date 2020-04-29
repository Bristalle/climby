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
* Classe permettant d'accéder à la table destination de la base de donnée
* La table destination permet de définir les différents critères de diner pouvant être assignés (1 seul par diner)
*/
class destination {

	/**
    * identifiant du destination
    * @access private
    *  @var integer
    */
    private $idd;

	/**
    * nom du destination
    * @access private
    *  @var string
    */
    private $nom;
	private $description;
	private $gps;
	private $critere;
	private $typeDeGrimpe;
	private $hauteurDuSpot;
	private $nbVoies;
	private $cotationMin;
	private $cotationMax;
	private $pays;
	private $region;

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
	public function insertDestination($nom, $description, $gps, $critere, $typeDeGrimpe, $hauteurDuSpot, $nbVoies, $cotationMin, $cotationMax, $pays, $region){
		$c = Base::getConnection();
		$query = $c->prepare("insert into destination (nom, description, gps, critere, typeDeGrimpe, hauteurDuSpot, nbVoies, cotationMin, cotationMax, pays, region)
							values (:nom, :description, :gps, :critere, :typeDeGrimpe, :hauteurDuSpot, :nbVoies, :cotationMin, :cotationMax, :pays, :region)");
		$query->bindParam (':nom',$nom, PDO::PARAM_STR);
		$query->bindParam (':description',$description, PDO::PARAM_STR);
		$query->bindParam (':gps',$gps, PDO::PARAM_STR);
		$query->bindParam (':critere',$critere, PDO::PARAM_INT);
		$query->bindParam (':typeDeGrimpe',$typeDeGrimpe, PDO::PARAM_INT);
		$query->bindParam (':hauteurDuSpot',$hauteurDuSpot, PDO::PARAM_INT);
		$query->bindParam (':nbVoies',$nbVoies, PDO::PARAM_INT);
		$query->bindParam (':cotationMin',$cotationMin, PDO::PARAM_STR);
		$query->bindParam (':cotationMax',$cotationMax, PDO::PARAM_STR);
		$query->bindParam (':pays',$pays, PDO::PARAM_STR);
		$query->bindParam (':region',$region, PDO::PARAM_STR);
		$query->execute();
	}

	public function getDestinationById($idd) {
		$c = Base::getConnection();
        $d = new destination();
        $reponse = $c->query('SELECT * FROM destination WHERE idd ='.$idd);
        $donnees = $reponse->fetch();
        return $donnees;
	}

	// Fonction qui retourne la liste des destinations
    public function getAllDestinations(){
        $c=Base::getConnection();
        $query = $c->prepare("select * from destination");
        $c = base::getConnection();
        $dbres = $query->execute();
        $d = $query->fetchAll();
        return $d;
    }
	
	public function deleteDestination($idd) {
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM destination WHERE idd = :idd");
		$query->bindParam(':idd', $idd, PDO::PARAM_INT);
		$query->execute();
	}
}
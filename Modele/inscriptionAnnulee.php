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
* Classe permettant d'accéder à la table réservation de la base de donnée
* La table réservation définit le lien entre un utilisateur et un diners réservé par ce dernier à un certaine date
*/
class inscriptionAnnulee
{

    private $idi;
	private $participant;
	private $event;
	private $date;
	private $dateannul;

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


    public function insertInscriptionAnnuleeWithId($idi, $participant,$event,$date, $dateannul){
        $c = Base::getConnection();
        $query = $c->prepare("insert into inscriptionannulee(idi, participant, event, date, dateannul) values(:idi, :participant,:event,:date,:dateannul)");
        $query->bindParam (':idi', $idi, PDO::PARAM_INT);
		$query->bindParam (':participant',$participant, PDO::PARAM_INT);
        $query->bindParam (':event',$event, PDO::PARAM_INT);
        $query->bindParam (':date',$date, PDO::PARAM_INT);
		$query->bindParam (':dateannul',$dateannul, PDO::PARAM_INT);
        $query->execute();
    }

	public function getInscriptionAnnuleeById($idi) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM inscriptionannulee WHERE idi = :idi");
		$query->bindParam (':idi', $idi, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}
	
	public function restoreInscriptionAnnulee($idi) {
		$ia = $this.getInscriptionAnnuleeById($idi);
		$c = Base::getConnection(); 
		$query = $c->prepare("DELETE FROM inscriptionannulee WHERE idi = :idi");
		$query->bindParam (':idi', $idi, PDO::PARAM_INT);
		$query->execute();
		$i = new inscription();
		$i->insertInscriptionWithId($ia['idi'], $ia['participant'], $ia['event'], $ia['date']);
	}

	public function deleteInscriptionAnnulee($idi) {
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM inscriptionannulee WHERE idi = :idi");
		$query->bindParam (':idi', $idi, PDO::PARAM_INT);
		$query->execute();
	}

	// Fonction retournant la liste des informations d'une réservation
    public function getInfosResa($idr){
/*        $c = Base::getConnection();
        $reponse = $c->query('SELECT jour, nom, date, lieu, description, prix, capacite, r.idd idDiner FROM inscription as r, diner as d WHERE r.idd = d.idd AND idr ='.$idr);
        $r = $reponse->fetch();
        $resa = new inscription();
        $resa->idr = $idr;
        $resa->jour = $r['jour'];
        $resa->nom = $r['nom'];
        $resa->date = $r['date'];
        $resa->lieu = $r['lieu'];
        $resa->desc = $r['description'];
        $resa->prix = $r['prix'];
        $resa->capacite = $r['capacite'];
        $resa->idd = $r['idDiner'];
        return $resa;*/return array();
    }
	
    // Fonction retournant le nombre de participants à un diner
    public function getNbParticipants($idd){
 /*   	$c = Base::getConnection();
    	$result = $c->query("SELECT COUNT(*) as total FROM inscription WHERE idd=".$idd);
    	$data=$result->fetch();
		return $data['total'];*/return null;
    }

    // Fonction retournant la liste des réservations d'un utilisateur pour des diners à venir seulement
    public function getResaEnCours($idu){
/*    	$c = Base::getConnection();
    	$result = $c->query("SELECT idr, jour, nom, date, lieu, description, prix, capacite, r.idd as idDiner FROM inscription as r, diner as d WHERE r.idd = d.idd AND r.idu =".$idu." AND date > CURDATE()");
    	$listeR = array();
    	while ($r = $result->fetch()){
    		$resa = new inscription();
            $resa->idr = $r['idr'];
            $resa->jour = $r['jour'];
            $resa->nom = $r['nom'];
            $resa->date = $r['date'];
            $resa->lieu = $r['lieu'];
            $resa->desc = $r['description'];
            $resa->prix = $r['prix'];
            $resa->capacite = $r['capacite'];
            $resa->idd = $r['idDiner'];
            $resa->nbPart = $resa->getNbParticipants($resa->idd);

            $listeR[] = $resa;
        }
        return $listeR;*/ return array();
    }

    public static function getAll($idu) {
/*        $c = Base::getConnection();
        $query = $c->prepare("select * from inscription where idu=".$idu);
        $query->execute();
        $query = $query->fetchAll();
        return $query;*/ return array();
    }

    // Fonction retournant la liste des réservations d'un utilisateur pour des diners déjà terminés seulement (historique)
    public function getHistoResa($idu){
/*    	$c = Base::getConnection();
    	$result = $c->query("SELECT idr, jour, nom, date, lieu, description, prix, capacite, r.idd idDiner FROM inscription as r, diner as d WHERE r.idd = d.idd AND r.idu =".$idu." AND date <= CURDATE()");
    	$listeR = array();
    	while ($r = $result->fetch()){
    		$resa = new inscription();
            $resa->idr = $r['idr'];
            $resa->jour = $r['jour'];
            $resa->nom = $r['nom'];
            $resa->date = $r['date'];
            $resa->lieu = $r['lieu'];
            $resa->desc = $r['description'];
            $resa->prix = $r['prix'];
            $resa->capacite = $r['capacite'];
            $resa->idd = $r['idDiner'];
            $resa->nbPart = $resa->getNbParticipants($resa->idd);

            $listeR[] = $resa;
        }
        return $listeR;*/ return array();
    }

	//Fonction pour récupérer la liste des réservations pour un diner donné
    public function getResaDiner($idd){
/*        $c = Base::getConnection();
        $result = $c->query('SELECT idr, r.idu iduR, jour, nom, date, lieu, description, prix, capacite FROM inscription as r, diner as d WHERE r.idd = d.idd AND r.idd ='.$idd);
        $listeR = array();
        while ($r = $result->fetch()){
            $resa = new inscription();
            $resa->idr = $r['idr'];
            $resa->idu = $r['iduR'];
            $resa->jour = $r['jour'];
            $resa->nom = $r['nom'];
            $resa->date = $r['date'];
            $resa->lieu = $r['lieu'];
            $resa->desc = $r['description'];
            $resa->prix = $r['prix'];
            $resa->capacite = $r['capacite'];
            $resa->idd = $idd;

            $listeR[] = $resa;
        }
        return $listeR;*/ return array();
    }
	
    //Fonction pour supprimer une réservation
    public static function deleteResa($idr) {
/*        $c = Base::getConnection();
        $query = $c->prepare("DELETE from inscription where idr=:idr");
        $query->bindParam(':idr', $idr, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();*/return null;
    }

    public function count($idd)
    {
        /*return $idd;*/ return null;
    }

}
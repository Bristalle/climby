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
* Classe permettant d'accéder à la table event de la base de donnée
* La table event définit les events proposés sur le site.
*/
class event{

    private $ide;
    private $destination;
    private $createur;
	private $hasLead;
	private $nbPlace;
	private $niveaux;
	private $date;

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


    // Fonction permettant d'ajouter un nouveau event dans la base
    public function insertEvent($destination, $createur, $hasLead, $nbPlace, $niveaux, $date){
        $c = Base::getConnection();
        $query = $c->prepare("insert into event(destination, createur, hasLead, nbPlace, niveaux, date)
                          values(:destination, :createur, :hasLead, :nbPlace, :niveaux, :date)");
        $query->bindParam (':destination',$destination, PDO::PARAM_INT);
        $query->bindParam (':createur',$createur, PDO::PARAM_STR);
        $query->bindParam (':lieu',$lieu, PDO::PARAM_STR);
        $query->bindParam (':description',$description, PDO::PARAM_STR);
        $query->bindParam (':prix',$prix, PDO::PARAM_INT);
        $query->bindParam (':date',$date, PDO::PARAM_STR);
        $query->bindParam (':capacite',$capacite, PDO::PARAM_INT);
        $query->bindParam (':critere',$critere, PDO::PARAM_INT);
		$query->bindParam (':date',$date, PDO::PARAM_INT);
        $query->execute();
    }
	
	public function updateEvent($ide, $destination, $createur, $hasLead, $nbPlace, $niveaux, $date) {
		$c = Base::getConnection();
		$req = $c->prepare("UPDATE event SET destination = :destination, createur = :createur, hasLead = :hasLead, nbPlace = :nbPlace, niveaux = :niveaux, date = :date WHERE ide = :ide");  
		$req->bindParam (':destination', $destination, PDO::PARAM_INT);
		$req->bindParam (':createur', $createur, PDO::PARAM_INT);
		$req->bindParam (':hasLead', $hasLead, PDO::PARAM_BOOL);
		$req->bindParam (':nbPlace', $nbPlace, PDO::PARAM_INT);
		$req->bindParam (':niveaux', $niveaux, PDO::PARAM_STR);
		$req->bindParam (':date', $date, PDO::PARAM_INT);
		$req->bindParam (':ide', $ide, PDO::PARAM_INT);
		$req->execute();
        return $req->rowCount();
	}
	
	public function getEventById($ide) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM event WHERE ide = :ide");
		$query->bindParam(':ide', $ide, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}
	
	public function getAllEvents() {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM event");
		$query->execute();
		return $query->fetchAll();
	}
	
	public function deleteEvent($ide) {
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM event WHERE ide = :ide");
		$query->bindParam (':ide', $ide, PDO::PARAM_INT);
		$query->execute();
	}

    //Fonction retournant les 3 derniers events postés avec leurs images
    public function get3Latest(){
/*        $c = Base::getConnection();
        $query = $c->query("SELECT idd,idu,nom,date,lieu,description,prix,capacite FROM event order by idd desc limit 3");
        $listeD = array();
        while ($k = $query->fetch()){
            $d = new event();
            $i=new image();
            $d->idd = $k['idd'];
            $d->idu = $k['idu'];
            $d->nom = $k['nom'];
            $d->date = $k['date'];
            $d->lieu = $k['lieu'];
            $d->desc = $k['description'];
            $d->prix = $k['prix'];
            $d->capacite = $k['capacite']; 
            $d->photos= $i->getPhotos($k['idd']);
            $listeD[] = $d;
        }
        return $listeD;*/return array();
    }

    // Fonction retournant la liste des events à venir pour un hote donné
    public function geteventsAvenir($idu){
 /*       $listeD = array();
        $r = new reservation();
        $c = Base::getConnection();
        $res = $c->query("select idd, idu, nom, date, lieu, description, prix, capacite from event where date > CURDATE() AND idu = ".$idu);

        while ($donnees = $res->fetch()){
            $d = new event();
            $d->idd = $donnees['idd'];
            $d->idu = $donnees['idu'];
            $d->nom = $donnees['nom'];
            $d->date = $donnees['date'];
            $d->lieu = $donnees['lieu'];
            $d->desc = $donnees['description'];
            $d->prix = $donnees['prix'];
            $d->capacite = $donnees['capacite']; 
            $d->nbPart = $r->getNbParticipants($d->idd);
            $listeD[] = $d;
        }
        return $listeD;*/ return array();
    }

    // Fonction retournant la liste des events passés pour un hote donné (historique)
    public function getHistoevents($idu){
 /*       $listeD = array();
        $r = new reservation();
        $c = Base::getConnection();
        $res = $c->query("select idd, idu, nom, date, lieu, description, prix, capacite from event where date <= CURDATE() AND idu = ".$idu);

        while ($donnees = $res->fetch()){
            $d = new event();
            $d->idd = $donnees['idd'];
            $d->idu = $donnees['idu'];
            $d->nom = $donnees['nom'];
            $d->date = $donnees['date'];
            $d->lieu = $donnees['lieu'];
            $d->desc = $donnees['description'];
            $d->prix = $donnees['prix'];
            $d->capacite = $donnees['capacite']; 
            $d->nbPart = $r->getNbParticipants($d->idd);
            $listeD[] = $d;
        }
        return $listeD;*/ return array();
    }

	// Fonction retournant les informations d'un event choisi par son idd
    public function getInfosevent($idd){
/*        $c = Base::getConnection();
        $d = new event();
        $reponse = $c->query('SELECT * FROM event WHERE idd ='.$idd);
        $donnees = $reponse->fetch();
        $d->idd = $idd;
        $d->idu = $donnees['idu'];
        $d->nom = $donnees['nom'];
        $d->date = $donnees['date'];
        $d->lieu = $donnees['lieu'];
        $d->desc = $donnees['description'];
        $d->prix = $donnees['prix'];
        $d->capacite = $donnees['capacite']; 
        return $d;*/ return array();
    }

	// Fonction retournant les events répondants à la recherche
	public function rechercher($idu,$nom,$date ,$prix, $capa, $critere, $lieu){
/*        $c = base::getConnection();
        $request = "SELECT * FROM event where 1";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Debut Test <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        if (!empty($nom)){
            $nom = strip_tags(htmlentities($nom));
            $request.=" and nom LIKE '%".$nom."%'";
        }

        if (!empty($date)){
            $date = strip_tags(htmlentities($date));
            $request.=" and date='".$date."'";
        }
        if (!empty($prix)){
            $prix = strip_tags(htmlentities($prix));
            $request.=" and prix <= ".$prix." order by prix ASC";
        }

        if (!empty($capa)) {
            $capa = strip_tags(htmlentities($capa));
            $request.=" and capacite <= ".$capa;
        }

        if (!empty($critere)) {
            $critere = strip_tags(htmlentities($critere));
            $request.=" and idc=".$critere;
        }

        if (!empty($lieu)){
            $lieu = strip_tags(htmlentities($lieu));
            $request.=" and lieu LIKE '%".$lieu."%'";
        }
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Fin Test <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

        $query = $c->prepare($request); //where nom LIKE '%".$nom."'"
        $dbres = $query->execute();
        $d = $query->fetchAll();
        $tab = array();
        foreach ($d as $key => $donnees) {
            $d = new event();
            $c = new critere();
            $i = new image();
            $d->idd = $donnees['idd'];
            $d->idu = $donnees['idu'];
            $d->nom = $donnees['nom'];
            $d->date = $donnees['date'];
            $d->desc = $donnees['description'];
            $d->lieu = $donnees['lieu'];
            $d->prix = $donnees['prix'];
            $d->capacite = $donnees['capacite'];
            $d->critere = $c->getId($donnees['idc']);
            $d->photos = $i->getAdd($donnees['idd']);
            $tab[] = $d;
        }
        return $tab;*/ return array();
    }
	
	// Fonction d'administration permettant de modifier un event
	public function updateeventAdmin($event){
/*		$c = Base::getConnection();
		$req = $c->prepare("UPDATE event SET idu = :newIdu, nom = :newNom, date = :newDate, lieu = :newLieu, description = :newDescr, prix = :newPrix, capacite = :newCapa WHERE idd = :idd");  
		$req->bindParam (':newIdu',$event->idu, PDO::PARAM_INT);
		$req->bindParam (':newNom',$event->nom, PDO::PARAM_STR);
		$req->bindParam (':newDate',$event->date, PDO::PARAM_STR);
		$req->bindParam (':newLieu',$event->lieu, PDO::PARAM_STR);
		$req->bindParam (':newDescr',$event->desc, PDO::PARAM_STR);
		$req->bindParam (':newPrix', $event->prix, PDO::PARAM_INT);
		$req->bindParam (':newCapa',$event->capacite, PDO::PARAM_INT);
		$req->bindParam (':idd',$event->idd, PDO::PARAM_INT); 
		$req->execute(); */
    }
}
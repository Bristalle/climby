<?php
/**
* Fichier de Modele
*/

include_once 'image.php';
include_once 'reservation.php';
include_once 'critere.php';


if (file_exists('base.php')){
    include_once 'base.php';
}
else {
    include_once '../base.php';
}
/**
* Classe permettant d'accéder à la table diner de la base de donnée
* La table diner définit les diners proposés sur le site.
*/
class diner{
    /**
    * identifiant du diner
    * @access private
    *  @var integer
    */
    private $idd;

    /**
    * identifiant de l'hôte
    * @access private
    *  @var integer
    */
    private $idu;

    /**
    * nom du diner
    * @access private
    *  @var string
    */
    private $nom;
    
    /**
    * date du diner
    * @access private
    *  @var date
    */
    private $date;

    /**
     * date du diner
     * @access private
     *  @var date
     */
    private $photos;

    /**
    * lieu du diner
    * @access private
    *  @var string
    */
    private $lieu;

    /**
    * description du diner
    * @access private
    *  @var string
    */
    private $desc;


    /**
    * prix du diner
    * @access private
    *  @var integer
    */
    private $prix;

    /**
    * nombre maximum d'invités du diner
    * @access private
    *  @var integer
    */
    private $capacite;

    /**
    * Note du diner
    * @access private
    *  @var Integer
    */
    private $note;

    /**
     * Critère du diner
     * @access private
     *  @var Integer
     */
    private $critere;

    /**
    * nombre d'invité participant au diner à l'heure actuelle
    * @access private
    *  @var int
    */
    private $nbPart;

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


    // Fonction permettant d'ajouter un nouveau diner dans la base
    public function insert($idu, $nom, $lieu, $description, $prix , $date, $capacite,$image,$critere){
 /*       $c = Base::getConnection();
        $query = $c->prepare("insert into diner(idu,nom,lieu,description,prix,date, capacite,idc)
                          values(:idu,:nom,:lieu,:description,:prix, :date, :capacite, :critere)");
        $query->bindParam (':idu',$idu, PDO::PARAM_INT);
        $query->bindParam (':nom',$nom, PDO::PARAM_STR);
        $query->bindParam (':lieu',$lieu, PDO::PARAM_STR);
        $query->bindParam (':description',$description, PDO::PARAM_STR);
        $query->bindParam (':prix',$prix, PDO::PARAM_INT);
        $query->bindParam (':date',$date, PDO::PARAM_STR);
        $query->bindParam (':capacite',$capacite, PDO::PARAM_INT);
        $query->bindParam (':critere',$critere, PDO::PARAM_INT);
        $query->execute();

        $this->idd = $c->LastInsertId('diner');
		
        //insertion de l'image
        $i = new image();
        $i->insert($this->idd,$image);*/
    }

    //Fonction retournant les 3 derniers diners postés avec leurs images
    public function get3Latest(){
/*        $c = Base::getConnection();
        $query = $c->query("SELECT idd,idu,nom,date,lieu,description,prix,capacite FROM diner order by idd desc limit 3");
        $listeD = array();
        while ($k = $query->fetch()){
            $d = new diner();
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

    // Fonction retournant la liste des diners à venir pour un hote donné
    public function getDinersAvenir($idu){
 /*       $listeD = array();
        $r = new reservation();
        $c = Base::getConnection();
        $res = $c->query("select idd, idu, nom, date, lieu, description, prix, capacite from diner where date > CURDATE() AND idu = ".$idu);

        while ($donnees = $res->fetch()){
            $d = new diner();
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

    // Fonction retournant la liste des diners passés pour un hote donné (historique)
    public function getHistoDiners($idu){
 /*       $listeD = array();
        $r = new reservation();
        $c = Base::getConnection();
        $res = $c->query("select idd, idu, nom, date, lieu, description, prix, capacite from diner where date <= CURDATE() AND idu = ".$idu);

        while ($donnees = $res->fetch()){
            $d = new diner();
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

	// Fonction retournant les informations d'un diner choisi par son idd
    public function getInfosDiner($idd){
/*        $c = Base::getConnection();
        $d = new diner();
        $reponse = $c->query('SELECT * FROM diner WHERE idd ='.$idd);
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

	// Fonction retournant les diners répondants à la recherche
	public function rechercher($idu,$nom,$date ,$prix, $capa, $critere, $lieu){
/*        $c = base::getConnection();
        $request = "SELECT * FROM diner where 1";
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
            $d = new diner();
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
	
	// Fonction permettant de modifier un diner
    public function updateDiner($diner){
 /*       $c = Base::getConnection();
        if(isset($diner->idd) && isset($diner->nom) && isset($diner->desc) && isset($diner->capacite) && isset($diner->critere)){
                $req = $c->prepare("UPDATE diner SET nom = :newNom, description = :newDescr, capacite = :newCapa, idc = :newIdc WHERE idd = :idd");  
                $req->bindParam (':newNom',$diner->nom, PDO::PARAM_STR);
                $req->bindParam (':newDescr',$diner->desc, PDO::PARAM_STR);
                $req->bindParam (':newCapa',$diner->capacite, PDO::PARAM_STR);
				$req->bindParam (':newIdc',$diner->critere, PDO::PARAM_INT);
                $req->bindParam (':idd',$diner->idd, PDO::PARAM_INT); 
                $req->execute();
                return $req->rowCount();
        }
        else { return 0;}
        
*/return null;
    }
	
	// Fonction d'administration permettant de modifier un diner
	public function updateDinerAdmin($diner){
/*		$c = Base::getConnection();
		$req = $c->prepare("UPDATE diner SET idu = :newIdu, nom = :newNom, date = :newDate, lieu = :newLieu, description = :newDescr, prix = :newPrix, capacite = :newCapa WHERE idd = :idd");  
		$req->bindParam (':newIdu',$diner->idu, PDO::PARAM_INT);
		$req->bindParam (':newNom',$diner->nom, PDO::PARAM_STR);
		$req->bindParam (':newDate',$diner->date, PDO::PARAM_STR);
		$req->bindParam (':newLieu',$diner->lieu, PDO::PARAM_STR);
		$req->bindParam (':newDescr',$diner->desc, PDO::PARAM_STR);
		$req->bindParam (':newPrix', $diner->prix, PDO::PARAM_INT);
		$req->bindParam (':newCapa',$diner->capacite, PDO::PARAM_INT);
		$req->bindParam (':idd',$diner->idd, PDO::PARAM_INT); 
		$req->execute(); */
    }

	// Fonction permettant de supprimer un diner
    public function deleteDiner($idd){
/*        $c = Base::getConnection();
        $query = $c->prepare("DELETE from diner where idd=:idd");
        $query->bindParam(':idd', $idd, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();*/
    }
}
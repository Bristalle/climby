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
* Classe permettant d'accéder à la table image de la base de donnée
* La table image permet de définir un chemin jusqu'aux images, leur assignant un diner
*/
class image
{
    /**
     * Identifiant de l'image
     * @access private
     * @var integer
     */
    private $idi;

    /**
     * Adresse de l'image
     * @access private
     * @var integer
     */
    private $path;

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

	// Fonction permettant d'ajouter un nouvelle image dans la base
    public function insertImage($path){
		//Heberger l'image ?
		$c = Base::getConnection();
		$query = $c->prepare("insert into image(path)
					  values(:adresse)");
		$query->bindParam (':adresse',$path, PDO::PARAM_STR);
		$query->execute();
    }
	
	private function insertImageWithId($idi, $path){
		//Heberger l'image ?
		$c = Base::getConnection();
		$query = $c->prepare("insert into image(idi, path)
					  values(:idi, :adresse)");
		$query->bindParam (':idi', $idi, PDO::PARAM_INT);
		$query->bindParam (':adresse',$path, PDO::PARAM_STR);
		$query->execute();
    }

	public function getImage($idi) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM image WHERE idi = :idi");
		$query->bindParam (':idi',$idi, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}
	
	public function updateImage($idi, $path) {
		$this->deleteImage($idi);
		$this->insertImageWithId($idi, $path);
	}
	
	public function deleteImage($idi) {
		//Supprimer le fichier image
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM image WHERE idi = :idi");
		$query->bindParam (':idi',$idi, PDO::PARAM_INT);
		$query->execute();
	}

    // Fonction retournant l'adresse de l'image d'un diner donné
    public function getAdd($idd){
 /*       $c = Base::getConnection();
        $image=new image();
        if(isset($idd)){
            $result = $c->query("select idi,adresse from image where idd=".$idd);
            $donnees = $result->fetch();
            $image->idi = $donnees['idi'];
            $image->ad = $donnees['adresse'];
        }
        return $image;*/ return null;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
// a supprimer ?
    /*
     * Retourne toutes les images pour un diner d'id idd
     * @param $idd
     * @return array
     */
    public function getPhotos($idd){
 /*       $c = Base::getConnection();
        $listeP = array();
        if(isset($idd)){
            $result = $c->query("select idi,adresse from image where idd=".$idd);
            while ($img = $result->fetch()){
                $i=new image();
                $i->idi = $img['idi'];
                $i->idd = $idd;
                $i->ad = $img['adresse'];
                $listeP[] = $i;
            }
        }
        return $listeP;*/ return array();
    }

    //fonction qui retourne le code HTML d'un carousel composé des images d'un diner idd. Ne marche pas pour le moment
    public function getCarousel($idd){
 /*       $c = Base::getConnection();
        $listeP = array();
        $cpt = 0;
        if(isset($idd)){
            $result = $c->query("select adresse from image where idd=".$idd);

            while ($img = $result->fetch()){
                $listeP[] = $img['adresse'];
            }
        }
        
        $carousel = '<div id="carouselDetails" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">';

        $num = ""; 

        $adr = "";

        foreach($listeP as $p){
            
            if ($cpt == 0){
                $num .= '<li data-target="#carouselDetails" data-slide-to="'.$cpt.'" class="active"></li>';
                $adr .= '<div class="carousel-item active">
                          <img class="d-block img-fluid" src="'.$p.'" alt="Slide '.$cpt.'">
                        </div>';
            }
            else {
                $num .= '<li data-target="#carouselDetails" data-slide-to="'.$cpt.'"></li>';
                $adr .= '<div class="carousel-item">
                          <img class="d-block img-fluid" src="'.$p.'" alt="Slide '.$cpt.'">
                        </div>';
            }
            $cpt ++;

        }

        $carousel .= $num . '</ol>
                  <div class="carousel-inner" role="listbox">' . $adr . '</div>
                  <a class="carousel-control-prev" href="#carouselDetails" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselDetails" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>';

          return $carousel;*/ return null;
    }
////////////////////////////////////////////////////////////////////////////////////////////////
}

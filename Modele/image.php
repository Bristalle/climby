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
    private $idp;

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
		$query = $c->prepare("insert into image(path) values(:adresse)");
		$query->bindParam (':adresse',$path, PDO::PARAM_STR);
		$query->execute();
		return $c->lastInsertId('image');
    }
	
	public function uploadImage($fichier, $nom, $target, $max_size = 500000, $width_max = 5000, $height_max = 5000){
		$res = '';
		$idp = '1';
		$bool = true;
		
		
		//>>>>>>>>>>>>>>>>>>>>>>>> SCRIPT VERIFICATION IMAGE <<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//define('TARGET', $_SERVER['DOCUMENT_ROOT'] . '/Climby/Images/'); // Repertoire cible
		//define('TARGET', $linkIndex . 'Images/'); // Repertoire cible
		//define('MAX_SIZE', 500000); // Taille max en octets du fichier
		//define('WIDTH_MAX', 5000); // Largeur max de l'image en pixels
		//define('HEIGHT_MAX', 5000); // Hauteur max de l'image en pixels
		// Tableaux de donnees
		$tabExt = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
		$infosImg = array();
		// Variables
		$extension = '';
		$nomImage = '';
		$dossierCreer = true;
		/************************************************************
		 * Creation du repertoire cible si inexistant
		 *************************************************************/
		if (!is_dir($target)) {
			if (!mkdir($target, 0755)) {
				$res.='<div class="alert alert-danger" role="alert">Répertoire d\'image impossible à créer. Contactez un administrateur.</div>';
				$bool=false;
				$dossierCreer = false;
				/*exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');*/
			}
		}

			/************************************************************
			 * Script d'upload
			 *************************************************************/
		if($dossierCreer){
			$extension = pathinfo($fichier['name'], PATHINFO_EXTENSION); // Recuperation de l'extension du fichier
			if (in_array(strtolower($extension), $tabExt)) { // On verifie l'extension du fichier
				$infosImg = getimagesize($fichier['tmp_name']); // On recupere les dimensions du fichier
				if ($infosImg[2] >= 1 && $infosImg[2] <= 14) { // On verifie le type de l'image
					if (($infosImg[0] <= $width_max) && ($infosImg[1] <= $height_max) && (filesize($fichier['tmp_name']) <= $max_size)) { // On verifie les dimensions et taille de l'image
						if (isset($fichier['error']) && UPLOAD_ERR_OK === $fichier['error']) { // Parcours du tableau d'erreurs
							$nomImage = str_replace(' ', '_', $nom).'.'.$extension; // On nomme le fichier selon la destination qui a un nom unique 
							$increment = 0;
							while(file_exists($target . $nomImage)){ //On verifie qu'aucun fichier du même nom existe
								$increment = $increment + 1;
								$nomImage = $nomImage . strval($increment); //On increment le nom de l'image si besoin
							} 
							/* On teste l'upload*/
							if (move_uploaded_file($fichier['tmp_name'], $target . $nomImage)) {
								move_uploaded_file($fichier['tmp_name'], $target . $nomImage);
								$image = 'Images/' . $nomImage;
								$idp = $this->insertImage($image);
								$res .= '<div class="alert alert-success" role="alert">Upload de l\'image réussie.</div>';
							} else { // Sinon on affiche une erreur systeme
								$res.='<div class="alert alert-danger" role="alert">Echec de l\'upload de l\'image.</div>';
								$bool=false;
							}
						} else {
							$res.='<div class="alert alert-danger" role="alert">Erreur lors du chargement du formulaire. Reessayer plus tard.</div>';
							$bool=false;
						}
					} else { // Sinon erreur sur les dimensions et taille de l'image
						$res.='<div class="alert alert-danger" role="alert">Les dimensions ou le poid de l\'image ne sont pas respectés.</div>';
						$bool=false;
					}
				} else { // Sinon erreur sur le type de l'image
					$res.='<div class="alert alert-danger" role="alert">Le fichier n\'est pas une image.</div>';
					$bool=false;
				}
			} else { // Sinon on affiche une erreur pour l'extension
				$res.='<div class="alert alert-danger" role="alert">L\'extension du fichier n\'est pas reconnue. Extension attendue : .'.implode(' ,.', $tabExt).'.</div>';
				$bool=false;
			}
		}
	//>>>>>>>>>>>>>>>>>>>>>>>> SCRIPT VERIFICATION IMAGE <<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		return array("bool" => $bool, "res" => $res, "idp" => $idp);
	}
	
	private function insertImageWithId($idp, $path){
		//Heberger l'image ?
		$c = Base::getConnection();
		$query = $c->prepare("insert into image(idp, path) values(:idp, :adresse)");
		$query->bindParam (':idp', $idp, PDO::PARAM_INT);
		$query->bindParam (':adresse',$path, PDO::PARAM_STR);
		$query->execute();
		return $c->lastInsertId('image');
    }

	public function getImage($idp) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM image WHERE idp = :idp");
		$query->bindParam (':idp',$idp, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}
	
	public function getAllImages() {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM image");
		$query->execute();
		return $query->fetchAll();
	}
	
	public function updateImage($idp, $path) {
		$this->deleteImage($idp);
		$this->insertImageWithId($idp, $path);
		return $query->rowCount();
	}
	
	public function deleteImage($idp) {
		//Supprimer le fichier image
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM image WHERE idp = :idp");
		$query->bindParam (':idp',$idp, PDO::PARAM_INT);
		$query->execute();
		return $query->rowCount();
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

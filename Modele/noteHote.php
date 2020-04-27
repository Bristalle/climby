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
* Classe permettant d'accéder à la table noteHote de la base de donnée
* La table noteHote définit les notes d'Hote d'un utilisateur pour un diner par un invité.
*/

class noteHote
{
	/**
    * identifiant de la note
    * @access private
    *  @var int
    */
    private $idn_Hot;

    /**
    * identifiant du diner
    * @access private
    *  @var int
    */
    private $idd;

    /**
    * identifiant de l'hote
    * @access private
    *  @var int
    */
    private $idu_Hot;

    /**
    * identifiant de l'invité ayant donné la note
    * @access private
    *  @var int
    */
    private $idu_Inv;

    /**
    * nom du diner
    * @access private
    *  @var int
    */
    private $note;

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
	
	// Fonction permettant de créer une note d'Hote
	public function insert($idd, $idu_Hot, $idu_Inv, $note){
/*		$note = strval($note);
       	$c = Base::getConnection();
		$query = $c->prepare("insert into notehote(idd,idu_Hot,idu_Inv,note)
                              values(:idd, :idu_Hot, :idu_Inv, :note)");
        $query->bindParam (':idd',$idd, PDO::PARAM_INT);
        $query->bindParam (':idu_Hot',$idu_Hot, PDO::PARAM_INT);
        $query->bindParam (':idu_Inv',$idu_Inv, PDO::PARAM_INT);
        $query->bindParam (':note',$note, PDO::PARAM_STR);
        $query->execute();*/
	}

    // Fonction permettant d'obtenir la note (moyenne) d'un hote via son idu
    public function getMoyenneHote($idu){
 /*       $c = Base::getConnection();
        $listeN = array();
        if(isset($idu)){
            $result = $c->query("select note from notehote where idu_Hot=".$idu);
            $sum = 0;
            $cpt = 0;
            while ($note = $result->fetch()){
                $sum = $sum + $note['note'];
                $cpt++;
        	}
            if($cpt==0){
                return 0;
            }
            else{
                return $sum/$cpt;
            }
    	}*/
		return 5;
	}

    // Fonction permettant d'obtenir la note (moyenne) d'un diner
    public function getMoyenneDiner($idd){
 /*       $c = Base::getConnection();
        $listeN = array();
        $total = 0;
        $nbN = 0;
        $moy = 0;
        if(isset($idd)){
            $result = $c->prepare("select AVG(note) from notehote where idd=:idd");
			$result->bindParam(':idd', $idd, PDO::PARAM_INT);
			$result->execute();
			$res = $result->fetch();
			return $res['0'];
        }
        return $moy;*/ return 5;
    }
	
	// Fonction permettant de savoir si un utilisateur a déjà noté un diner
	public function getAlreadyNoted($idd, $idu){
 /*      $c = Base::getConnection();
        $query = $c->prepare("select count(*) from notehote where idd=:idd and idu_Inv=:idu");
        $query->bindParam(':idd', $idd, PDO::PARAM_INT);
		$query->bindParam(':idu', $idu, PDO::PARAM_INT);
        $query->execute();
		$nb = $query->fetch();
		$query->closeCursor();
		if ($nb['0'] == 1){
			$noted = true;
		}else{
			$noted = false;
		}
        return $noted;*/ return false;
	}
}

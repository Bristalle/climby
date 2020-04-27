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
* Classe permettant d'accéder à la table resaannulee de la base de donnée
* La table resaannulle définit les réservations qui ont été annulée
*/
class resaAnnulee
{
	/**
    * identifiant de l'annulation
    * @access private
    *  @var int
    */
    private $idra;

    /**
    * identifiant de la réservation annulée
    * @access private
    *  @var int
    */
    private $idr;

    /**
    * identifiant du diner
    * @access private
    *  @var int
    */
    private $idd;

    /**
    * identifiant de l'invité ayant réservé
    * @access private
    *  @var int
    */
    private $idu;

    /**
    * date à laquelle la réservation a été faite
    * @access private
    *  @var date
    */
    private $jour;

    /**
    * date à laquelle la réservation a été annulée
    *  @var date
    */
    private $dateAnnul;

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

	// Fonction permettant d'ajouter une réservation annulée
    public static function addResaAnnulee($idr, $idu, $idd, $jour, $mRemb) {
/*    	$c = Base::getConnection();
    	$now = date('Y-m-d');
        $query = $c->prepare("insert into resaannulee(idr, idu, idd, jour, dateAnnulation, montantRembourse)
                              values(:idr,:idu,:idd,:jour,:dateA,:mRemb)");
        $query->bindParam (':idr',$idr, PDO::PARAM_INT);
        $query->bindParam (':idu',$idu, PDO::PARAM_INT);
        $query->bindParam (':idd',$idd, PDO::PARAM_INT);
        $query->bindParam (':jour',$jour, PDO::PARAM_STR);
        $query->bindParam (':dateA', $now , PDO::PARAM_STR);
        $query->bindParam (':mRemb', $mRemb , PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();*/ return null;
    }
}
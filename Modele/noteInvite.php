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
* Classe permettant d'accéder à la table noteInvite de la base de donnée
* La table noteInvite définit la note d'un invite pour un diner donné.
*/
class noteInvite
{
	/**
    * identifiant de la note
    * @access private
    *  @var int
    */
    private $idn_Inv;

    /**
    * identifiant de l'invité
    * @access private
    *  @var int
    */
    private $idu_Inv;

    /**
    * identifiant de l'hote ayant donné la note
    * @access private
    *  @var int
    */
    private $idu_Hot;

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

    // Fonction permettant d'obtenir la note moyenne d'un invite donné
    public function getMoyenneInvite($idu){
 /*       $c = Base::getConnection();
        $listeN = array();
        if(isset($idu)){
            $result = $c->query("select note from noteinvite where idu_Inv=".$idu);
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

    // Fonction permettant d'obtenir la note invité attribuée à l'utilisateur idu par l'hote du diner idd
    public function getNoteInvite($idu, $idd){
 /*       $c = Base::getConnection();
        $result = $c->query("SELECT note FROM noteinvite WHERE idd=".$idd." AND idu_Inv=".$idu);
        $data=$result->fetch();
        return $data['note'];*/return 5;
    }
}
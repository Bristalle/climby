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
    private $idng;
	private $ciblenote;
	private $noteur;
	private $note;
	private $commentaire;

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

		public function insertNoteGuide($ciblenote, $noteur, $note, $commentaire){
       	$c = Base::getConnection();
		$query = $c->prepare("INSERT into noteguide(ciblenote, noteur, note, commentaire)
                              VALUES(:ciblenote, :noteur, :note, :commentaire)");
        $query->bindParam (':ciblenote',$ciblenote, PDO::PARAM_INT);
        $query->bindParam (':noteur',$noteur, PDO::PARAM_INT);
        $query->bindParam (':note',$note, PDO::PARAM_INT);
        $query->bindParam (':commentaire',$commentaire, PDO::PARAM_STR);
        $query->execute();
		return $c->lastInsertId('noteguide');
	}
	
	public function updateNoteGuide($idng, $ciblenote, $noteur, $note, $commentaire) {
		$c = Base::getConnection();
		$query = $c->prepare("UPDATE noteguide SET ciblenote = :ciblenote, noteur = :noteur, note = :note, commentaire = :commentaire WHERE idng = :idng");
		$query->bindParam(':ciblenote', $ciblenote, PDO::PARAM_INT);
		$query->bindParam(':noteur', $noteur, PDO::PARAM_INT);
		$query->bindParam(':note', $note, PDO::PARAM_INT);
		$query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
		$query->bindParam(':idng', $idng, PDO::PARAM_INT);
		$query->execute();
	}
	
	public function getNoteGuideById($idng) {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM noteguide WHERE idng = :idng");
		$query->bindParam(':idng', $idng, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}
	
	public function getAllNoteGuide() {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * FROM noteguide");
		$query->execute();
		return $query->fetchAll();
	}
	
	public function deleteNoteGuide($idng) {
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM noteguide WHERE idng = :idng");
		$query->bindParam (':idng', $idng, PDO::PARAM_INT);
		$query->execute();
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
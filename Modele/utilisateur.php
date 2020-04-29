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
* Classe permettant d'accéder à la table utilisateur de la base de donnée
* La table utilisateur définit les comptes inscrit
*/
class utilisateur{
    /**
    * identifiant de l'utilisateur
    * @access private
    *  @var integer
    */
    private $idu;

    /**
    * pseudo d'utilisateur
    * @access private
    *  @var string
    */
    private $pseudo;

    /**
    * addresse d'utilisateur
    * @access private
    *  @var string
    */
    private $addresse;

    /**
    * code postal d'utilisateur
    * @access private
    *  @var string
    */
    private $cp;

    /**
    * ville d'utilisateur
    * @access private
    *  @var string
    */
    private $ville;

    /**
    * numero de telephone d'utilisateur
    * @access private
    *  @var string
    */
    private $tel;

    /**
    * Mot de passe
    */
    private $mdp;

    /**
    * mail de l'utilisateur
    * @access private
    *  @var string
    */
    private $mail;

    /**
    * solde de l'utilisateur
    * @access private
    *  @var integer
    */
    private $solde;
	
	private $historique;
	private $diplome;
	private $dateInscription;

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

	// Fonction permettant d'ajouter un compte Abonne dans la base de donnée
    public function insertUtilisateur($mail, $mdp, $pseudo,$add,$cp,$ville,$tel, $solde, $acces, $niveau, $diplome){
		$mdp = password_hash($mdp, PASSWORD_BCRYPT);
		$dateInscription = time();
        $c = Base::getConnection();
        $query = $c->prepare("insert into utilisateur(email, mdp, pseudo, addresse, codePost, ville, telephone, solde, niveau, diplome, dateInscription)
                              values(:mail, :mdp, :pseudo,:add,:cp,:ville,:tel,:solde, :niveau, :diplome, :dateInscription)");
        $query->bindParam (':mail', $mail, PDO::PARAM_STR);
        $query->bindParam (':mdp',$mdp, PDO::PARAM_STR);
		$query->bindParam (':pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindParam (':add',$add, PDO::PARAM_STR);
        $query->bindParam (':cp',$cp, PDO::PARAM_STR);
        $query->bindParam (':ville',$ville, PDO::PARAM_STR);
        $query->bindParam (':tel',$tel, PDO::PARAM_STR);
		$query->bindParam (':solde', $solde, PDO::PARAM_INT);
		$query->bindParam (':niveau', $niveau, PDO::PARAM_INT);
		$query->bindParam (':diplome', $diplome, PDO::PARAM_STR);
		$query->bindParam (':dateInscription', $dateInscription, PDO::PARAM_INT);
        $query->execute();
	}
	
		// Fonction d'administration retournant la liste des informations d'un compte
	public static function getUtilisateurById($id){
        $c = Base::getConnection();
        $query = $c->prepare("SELECT * FROM utilisateur where idu = :idu");
		$query->bindParam (':idu',$id, PDO::PARAM_INT);
		$query->execute();
		$query = $query->fetchAll();
		return $query[0];
		return null;
    }
	
	public static function getAllUtilisateurs() {
		$c = Base::getConnection();
        $query = $c->prepare("select * from utilisateur");
        $query->execute();
        $query = $query->fetchAll();
        return $query;
	}
	
	// Fonction permettant de modifier les informations de compte d'un abonne
    public static function updateUtilisateur($id, $nEmail, $nMdp, $nPseudo, $nAdresse, $nCodep, $nVille, $nTel, $nSolde, $nAcces, $nNiveau, $nDiplome){
        $c = Base::getConnection();
		$req = $c->prepare("UPDATE utilisateur SET email = :newEmail, mdp = :newMdp, pseudo = :newPseudo, addresse = :newAdd, codePost = :newCP, ville = :newVille, telephone = :newTel, solde = :newSolde, acces = :newAcces, niveau = :newNiveau, diplome = :newDiplome WHERE idu = :idu");  
		$req->bindParam (':newEmail', $nEmail, PARAM_STR);
		$req->bindParam (':newMdp',$nMdp, PDO::PARAM_STR);
		$req->bindParam (':newPseudo',$nPseudo, PDO::PARAM_STR);
		$req->bindParam (':newAdd',$nAdresse, PDO::PARAM_STR);
		$req->bindParam (':newCP',$nCodep, PDO::PARAM_STR);
		$req->bindParam (':newVille',$nVille, PDO::PARAM_STR);
		$req->bindParam (':newTel',$nTel, PDO::PARAM_STR);
		$req->bindParam (':newSole',$nSolde, PDO::PARAM_INT);
		$req->bindParam (':newAcces',$nAcces, PDO::PARAM_INT);
		$req->bindParam (':newNiveau',$nNiveau, PDO::PARAM_INT);
		$req->bindParam (':newDiplome', $nDiplome, PDO::PARAM_STR);
		$req->bindParam (':idu',$id, PDO::PARAM_INT); 
		$req->execute();
        return $req->rowCount();
    }
	
	// Fonction permettant de retirer de la base un utilisateur donné
	public function deleteUtilisateur($idu){
		$c = Base::getConnection();
		$query = $c->prepare("DELETE FROM utilisateur WHERE idu = :idu");
		$query->bindParam(':idu', $idu, PDO::PARAM_INT);
		$query->execute();
	}
	
		// Fonction d'administration permettant d'ajouter un compte dans la base de donnée
	public function insertClientAdm($droit, $nom,$prenom, $add, $cp, $ville, $tel, $mail,$mdp){
/*		$c = Base::getConnection();
        $query = $c->prepare("insert into utilisateur(ida,nom,prenom,addresse,codePost,ville,telephone,email,mdp,solde)
                              values(:droit,:nom,:prenom,:add,:cp,:ville,:tel,:mail,sha1(:mdp),0)");
		$query->bindParam (':droit',$droit, PDO::PARAM_INT);
        $query->bindParam (':nom',$nom, PDO::PARAM_STR);
        $query->bindParam (':prenom',$prenom, PDO::PARAM_STR);
        $query->bindParam (':add',$add, PDO::PARAM_STR);
        $query->bindParam (':cp',$cp, PDO::PARAM_STR);
        $query->bindParam (':ville',$ville, PDO::PARAM_STR);
        $query->bindParam (':tel',$tel, PDO::PARAM_STR);
        $query->bindParam (':mail',$mail, PDO::PARAM_STR);
        $query->bindParam (':mdp',$mdp, PDO::PARAM_STR);
        $query->execute();
        $this->idu = $c->LastInsertId('utilisateur');

		//header("Location: /sallesgla/index.php");*/
	}
	
		// Fonction permettant de récupérer toutes les informations de tous les utilisateurs
    public static function getAll() {
 /*       $c = Base::getConnection();
        $query = $c->prepare("select * from utilisateur");
        $query->execute();
        $query = $query->fetchAll();
        return $query;*/
    }
	
	// Fonction permettant de récupérer tous les emails de tous les utilisateurs
    public function getAllEmail(){
/*        $c = Base::getConnection();
        $query = $c->prepare("select email from utilisateur");
        $query->execute();
        $query = $query->fetchAll();
        return $query;*/ return array();
    }
    
	// Fonction permettant de modifier les informations d'un compte abonne sauf l'email
    public static function updateInfosClientNoMail($id, $nNom, $nPrenom, $nAdresse, $nCodep, $nVille, $nTel){
/*        $c = Base::getConnection();
        if(isset($id) && isset($nNom) && isset($nPrenom) && isset($nAdresse) && isset($nCodep) && isset($nVille) && isset($nTel)){
                $req = $c->prepare("UPDATE utilisateur SET nom = :newNom, prenom = :newPrenom, addresse = :newAdd, codePost = :newCP, ville = :newVille, telephone = :newTel WHERE idu = :idu");  
                $req->bindParam (':newNom',$nNom, PDO::PARAM_STR);
                $req->bindParam (':newPrenom',$nPrenom, PDO::PARAM_STR);
                $req->bindParam (':newAdd',$nAdresse, PDO::PARAM_STR);
                $req->bindParam (':newCP',$nCodep, PDO::PARAM_STR);
                $req->bindParam (':newVille',$nVille, PDO::PARAM_STR);
                $req->bindParam (':newTel',$nTel, PDO::PARAM_STR);
                $req->bindParam (':idu',$id, PDO::PARAM_INT); 
                $req->execute();
        }
        return $req->rowCount();*/return null;
    }
	
	// Fonction d'administration permettant de modifier les informations d'un compte sauf l'email
	public static function updateInfosClientNoMailAdmin($id, $nNom, $nPrenom, $nAdresse, $nCodep, $nVille, $nTel, $nAcces){
/*        $c = Base::getConnection();
        if(isset($id) && isset($nNom) && isset($nPrenom) && isset($nAdresse) && isset($nCodep) && isset($nVille) && isset($nTel) && isset($nAcces)){
                $req = $c->prepare("UPDATE utilisateur SET nom = :newNom, prenom = :newPrenom, addresse = :newAdd, codePost = :newCP, ville = :newVille, telephone = :newTel, ida = :newAcces WHERE idu = :idu");  
                $req->bindParam (':newNom',$nNom, PDO::PARAM_STR);
                $req->bindParam (':newPrenom',$nPrenom, PDO::PARAM_STR);
                $req->bindParam (':newAdd',$nAdresse, PDO::PARAM_STR);
                $req->bindParam (':newCP',$nCodep, PDO::PARAM_STR);
                $req->bindParam (':newVille',$nVille, PDO::PARAM_STR);
                $req->bindParam (':newTel',$nTel, PDO::PARAM_STR);
				$req->bindParam (':newAcces',$nAcces, PDO::PARAM_INT);
                $req->bindParam (':idu',$id, PDO::PARAM_INT); 
                $req->execute();
        }
        return $req->rowCount();*/return null;
    }

	// Fonction permettant de modifier le solde d'un compte
    public static function updateSoldeClient($id, $solde){
 /*       $c = Base::getConnection();
        $req = $c->prepare("update utilisateur set solde=:nsolde where idu=:id");
        $req->bindParam (':nsolde', $solde, PDO::PARAM_INT);
        $req->bindParam (':id', $id, PDO::PARAM_INT);
        $req->execute();*/
    }

	// Fonction permettant de modifier le mot de passe d'un compte
    public static function updateMdpClient($id, $mdp){
/*        $c = Base::getConnection();
        $req = $c->prepare("UPDATE utilisateur SET  mdp = sha1(:newMdp) WHERE idu = :idu");
        $req->bindParam (':newMdp',$mdp, PDO::PARAM_STR);
        $req->bindParam (':idu',$id, PDO::PARAM_STR);
        $req->execute();*/

    }

	// Fonction permettant de modifier le niveau d'acces d'un compte donné
    public static function updateDroits($ida, $id){
/*        $c = Base::getConnection();
        $req = $c->prepare("UPDATE utilisateur SET  ida = :ida WHERE idu = :idu");
        $req->bindParam (':ida',$ida, PDO::PARAM_STR);
        $req->bindParam (':idu',$id, PDO::PARAM_STR);
        $req->execute();*/
    }  

    // Fonction permettant de créditer le compte d'un utilisateur donné, d'un montant donné
    public static function credSolde($idu, $montant){
/*        $c = Base::getConnection();
        $req = $c->prepare("UPDATE utilisateur SET  solde = solde + :somme WHERE idu = :idu");
        $req->bindParam (':somme',$montant, PDO::PARAM_STR);
        $req->bindParam (':idu',$idu, PDO::PARAM_STR);
        $req->execute();
        return $req->rowCount();*/return null;
    }

	// Fonction permettant de débiter le compte d'un utilisateur donné, d'un montant donné
    public function retirerSolde($idu, $montant){
/*        $c = Base::getConnection();
        $req = $c->prepare("UPDATE utilisateur SET  solde = solde - :somme WHERE idu = :idu");
        $req->bindParam (':somme',$montant, PDO::PARAM_STR);
        $req->bindParam (':idu',$idu, PDO::PARAM_STR);
        $req->execute();
        return $req->rowCount();*/ return null;
    }
	
	// Fonction permettant de compte le nombre d'utilisateur ayant un identifiant et un mot de passe donné
    public static function verifMdpClient($id, $mdp){
/*        $c = Base::getConnection();
        $query = $c->prepare("select * from utilisateur where idu = :idu and mdp = sha1(:psw)");
        $query->bindParam(':idu', $id, PDO::PARAM_STR);
        $query->bindParam(':psw', $mdp, PDO::PARAM_STR);
        $query->execute();

        return $query->rowCount() == 1;*/ return null;
    }    
	

}
<?php
/**
* Fichier du Controlleur
*/
if (file_exists("index.php")){
    $linkIndex = './';
}
else {
    $linkIndex = '../';
}

include_once 'Controller.php';
include_once $linkIndex.'Vue/menuBarre.php';
include_once $linkIndex.'Modele/utilisateur.php';
include_once $linkIndex.'Modele/noteGuide.php';
include_once $linkIndex.'Modele/noteDestination.php';
include_once $linkIndex.'Modele/event.php';
include_once $linkIndex.'Modele/destination.php';
include_once $linkIndex.'Modele/image.php';
include_once $linkIndex.'Modele/inscriptionAnnulee.php';
include_once $linkIndex.'Modele/inscription.php';
include_once $linkIndex.'Modele/niveau.php';
include_once $linkIndex.'Modele/acces.php';
include_once $linkIndex.'Modele/critere.php';
include_once $linkIndex.'Modele/typeGrimpe.php';

/**
*
* Classe permettant de faire le lien entre la Vue et le Modele.
* Elle rassemble les fonctions de transition, de vérification et de test du site.
*/
class FuncController extends Controller{
    public  function __construct(){
        $this->tab=array(
			"ajaxForUpdateDestination" => "ajaxForUpdateDestination",
			"ajaxForUpdateUtilisateur" => "ajaxForUpdateUtilisateur",
			"ajaxForUpdateEvent" => "ajaxForUpdateEvent",
			"getTheBarre" => "getTheBarre",
			"getBouttonAccueil" => "getBouttonAccueil",
			"getReturnedPage" => "getReturnedPage",
			"getSelectBoxInitializedUtilisateur" => "getSelectBoxInitializedUtilisateur",
			"getSelectBoxInitializedDestination" => "getSelectBoxInitializedDestination",
			"getSelectBoxInitializedEvent" => "getSelectBoxInitializedEvent",
			"getSelectBoxInitializedNiveaux" => "getSelectBoxInitializedNiveaux",
			"getSelectBoxInitializedCritere" => "getSelectBoxInitializedCritere",
			"getSelectBoxInitializedTypeGrimpe" => "getSelectBoxInitializedTypeGrimpe",
			"getSelectBoxInitializedCotation" => "getSelectBoxInitializedCotation",
			"getSelectBoxInitializedAcces" => "getSelectBoxInitializedAcces",
			"getSelectBoxInitializedInscription" => "getSelectBoxInitializedInscription",
			"getSelectBoxInitializedInscriptionAnnulee" => "getSelectBoxInitializedInscriptionAnnulee",
			"getModalFormulaireCreationCompte" => "getModalFormulaireCreationCompte",
			"getModalFormulaireConnexion" => "getModalFormulaireConnexion",
			"getModalFormulaireRecherche" => "getModalFormulaireRecherche",
			"getModalFormulaireContacterAdmin" => "getModalFormulaireContacterAdmin",
			//"getModalFormulaireCreationEvent" => "getModalFormulaireCreationEvent",
			"getModalMonCompte" => "getModalMonCompte", 
			"getModalFormulaireDeconnexion" => "getModalFormulaireDeconnexion",
			"getModalMenuAdministration" => "getModalMenuAdministration",
			//"getModalFormulaireCreationEventByAdmin" => "getModalFormulaireCreationEventByAdmin",
			"getModalFormulaireCreationCritereAdmin" => "getModalFormulaireCreationCritereAdmin",
			"getModalFormulaireModificationCritereAdmin" => "getModalFormulaireModificationCritereAdmin",
			"getModalFormulaireSuppressionCritereAdmin" => "getModalFormulaireSuppressionCritereAdmin",
			"getModalFormulaireCreationDestinationAdmin" => "getModalFormulaireCreationDestinationAdmin",
			"getModalFormulaireSuppressionDestinationAdmin" => "getModalFormulaireSuppressionDestinationAdmin",
			"getModalFormulaireCreationTypeDeGrimpeAdmin" => "getModalFormulaireCreationTypeDeGrimpeAdmin",
			"getModalFormulaireModificationTypeDeGrimpeAdmin" => "getModalFormulaireModificationTypeDeGrimpeAdmin",
			"getModalFormulaireSuppressionTypeDeGrimpeAdmin" => "getModalFormulaireSuppressionTypeDeGrimpeAdmin",
			"getModalFormulaireCreationNiveauAdmin" => "getModalFormulaireCreationNiveauAdmin",
			"getModalFormulaireModificationNiveauAdmin" => "getModalFormulaireModificationNiveauAdmin",
			"getModalFormulaireSuppressionNiveauAdmin" => "getModalFormulaireSuppressionNiveauAdmin",
			"getModalFormulaireCreationUtilisateurAdmin" => "getModalFormulaireCreationUtilisateurAdmin",
			"getModalFormulaireModificationUtilisateurAdmin" => "getModalFormulaireModificationUtilisateurAdmin",
			"getModalFormulaireSuppressionUtilisateurAdmin" => "getModalFormulaireSuppressionUtilisateurAdmin",
			"getModalFormulaireCreationEventAdmin" => "getModalFormulaireCreationEventAdmin",
			"getModalFormulaireModificationEventAdmin" => "getModalFormulaireModificationEventAdmin", 
			"getModalFormulaireSuppressionEventAdmin" => "getModalFormulaireSuppressionEventAdmin",
			"getModalCreationInscriptionAdmin" => "getModalCreationInscriptionAdmin",
			"getModalArchivageInscriptionAdmin" => "getModalArchivageInscriptionAdmin",
			"getModalRestaurationInscriptionAdmin" => "getModalRestaurationInscriptionAdmin",
			"getModalSuppressionInscriptionAdmin" => "getModalSuppressionInscriptionAdmin",
			"getModalScriptForMenuBarre" => "getModalScriptForMenuBarre",
			"getJumbotron" => "getJumbotron",
			"getModalEnSavoirPlus" => "getModalEnSavoirPlus",
			"formulaireCreerCompteUtilisateur" => "formulaireCreerCompteUtilisateur",
			"formulaireCreerDestinationAdmin" => "formulaireCreerDestinationAdmin",
			"formulaireModifierDestinationAdmin" => "formulaireModifierDestinationAdmin",
			"formulaireSupprimerDestinationAdmin" => "formulaireSupprimerDestinationAdmin",
	//		"creerDinerAdmin" => "creerDinerAdmin",
	//		"participer" => "participer",
	//		"noterDiner" => "noterDiner",
			"getAllUtilisateurs" => "getAllUsers",
			"getUtilisateurId" => "getUtilisateurId",
	//		"getInfoDinerByIdd" => "getInfoDinerByIdd",
	//		"getAllDinerAvenirByIdu" => "getAllDinerAvenirByIdu",
	//		"getHistoDinerByIdu" => "getHistoDinerByIdu",
	//		"rechercherDiner" => "rechercherDiner",
	//		"getNbParticipantsByIdd" => "getNbParticipantsByIdd",
	//		"getResaEnCoursByIdu" => "getResaEnCoursByIdu",
	//		"getHistoResaByIdu" => "getHistoResaByIdu",
	//		"getNoteMoyenneHoteByIdu" => "getNoteMoyenneHoteByIdu",
	//		"getNoteMoyenneHoteByIdd" => "getNoteMoyenneHoteByIdd",
	//		"getNoteMoyenneInviteByIdu" => "getNoteMoyenneInviteByIdu",
	//		"getNoteInviteByIdd" => "getNoteInviteByIdd",
	//		"dinerDejaNote" => "dinerDejaNote",
	//		"modifCompteAdmin" => "modifCompteAdmin",
	//		"modifierDiner" => "modifierDiner",
	//		"modifDinerAdmin" => "modifDinerAdmin",
	//		"annulerDiner" => "annulerDiner",
	//		"annulerResa" => "annulerResa",
	//		"contactAdmin" => "contactAdmin",
	//		"get3LatestDiners" => "get3LatestDiners",
    //      "insert_resa" => "insert_resa",
    //      "justDoIt" => "justDoIt",
    //      "retirerSolde" => "retirerSolde",
    //      "getSolde" => "getSolde",
    //      "getResaEnCours" => "getResaEnCours",
			"getAccesById" => "getAccesById",
			"getAccesByNom" => "getAccesByNom",
			"getAllNiveaux" => "getAllNiveaux",
			"getAllCriteres" => "getAllCriteres",
			"getAllTypeDeGrimpe" => "getAllTypeDeGrimpe",
			"getAllCotations" => "getAllCotations",
			"formulaireChangerMdp" => "formulaireChangerMdp",
			"formulaireChangerMdpAdmin" => "formulaireChangerMdpAdmin",
			"formulaireUpdateUtilisateur" => "formulaireUpdateUtilisateur",
			"formulaireCreerCritereAdmin" => "formulaireCreerCritereAdmin",
			"formulaireModifierCritereAdmin" => "formulaireModifierCritereAdmin",
			"formulaireSupprimerCritereAdmin" => "formulaireSupprimerCritereAdmin",
			"formulaireCreerTypeDeGrimpeAdmin" => "formulaireCreerTypeDeGrimpeAdmin",
			"formulaireModifierTypeDeGrimpeAdmin" => "formulaireModifierTypeDeGrimpeAdmin",
			"formulaireSupprimerTypeDeGrimpeAdmin" => "formulaireSupprimerTypeDeGrimpeAdmin",
			"formulaireCreerNiveauAdmin" => "formulaireCreerNiveauAdmin",
			"formulaireModifierNiveauAdmin" => "formulaireModifierNiveauAdmin",
			"formulaireSupprimerNiveauAdmin" => "formulaireSupprimerNiveauAdmin",
			"formulaireCreerUtilisateurAdmin" => "formulaireCreerUtilisateurAdmin",
			"formulaireModifierUtilisateurAdmin" => "formulaireModifierUtilisateurAdmin",
			"formulaireSupprimerUtilisateurAdmin" => "formulaireSupprimerUtilisateurAdmin",
			"formulaireCreerEventAdmin" => "formulaireCreerEventAdmin",
			"formulaireModifierEventAdmin" => "formulaireModifierEventAdmin",
			"formulaireSupprimerEventAdmin" => "formulaireSupprimerEventAdmin",
			"formulaireCreerInscriptionAdmin" => "formulaireCreerInscriptionAdmin",
			"formulaireArchiverInscriptionAdmin" => "formulaireArchiverInscriptionAdmin",
			"formulaireRestaurerInscriptionAdmin" => "formulaireRestaurerInscriptionAdmin",
			"formulaireSupprimerInscriptionAdmin" => "formulaireSupprimerInscriptionAdmin",
        );
    }
	
	public function ajaxForUpdateDestination() {
		if(isset($_GET['b'])){
			$d = new destination();
			echo json_encode($d->getDestinationById(strip_tags(htmlentities($_GET['b']))));
		} else {
			echo "ERROR";
		}
	}
	
	public function ajaxForUpdateUtilisateur() {
		if(isset($_GET['b'])){
			$u = new utilisateur();
			echo json_encode($u->getUtilisateurById(strip_tags(htmlentities($_GET['b']))));
		}
	}
	
	public function ajaxForUpdateEvent() {
		if(isset($_GET['b'])){
			$e = new event();
			echo json_encode($e->getEventById(strip_tags(htmlentities($_GET['b']))));
		}
	}
	
	public function getTheBarre() {
		// Chargement de la barre de navigation
        session_start();
        $barre = "barreVisiteur";
        if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
        {
            $grade=$_SESSION['acces'];
            $id=$_SESSION['idu'];

            switch($grade) {
                case "Inscrit":
                    $barre = "barreAbonne";
                    break;
				case "Guide":
					$barre = "barreAbonne";
					break;
				case "Moderateur":
					$barre = "barreAbonne";
                case "Administrateur":
                    $barre = "barreAdmin";
                    break;
            }
        }else{
            if(isset($grade))
                unset($grade);
        }
		return $barre;
	}
	
	public function getBouttonAccueil($lnkInd) {
	$html = '
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				</button>
				<a class="navbar-brand" href="'.$lnkInd.'index.php">Accueil</a>
			</div>';
	return $html;
	}
	
	public function getReturnedPage($content) {
		$v = new menuBarre();
		$barre = $this->getTheBarre();
		$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Climby</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
    <link type="text/css" href="Css/menuBarre.css" rel="stylesheet" />
    <link type="text/css" href="Css/index.css" rel="stylesheet" />
    <link type="text/css" href="./bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link type="text/css" href="./bootstrap/datepicker/css/datepicker.css" rel="stylesheet"/>
    <link type="text/css" href="./slider/css/slider.css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>
	<script src="jquery-2.1.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body id="body">'
.$v->affichage($barre)
.'<div class="container">'
    .$this->getJumbotron()
	.'<div class="alert alert-success" role="alert">
    '.$content.'
    </div>';
	return $html;
	}
	
	public function getSelectBoxInitializedUtilisateur($disableZero=false, $selectedId=0, $id='', $multi=false) {
		$u = new utilisateur();
		$utilisateurs = $u->getAllUtilisateurs();
		$utis = "";
		
		foreach($utilisateurs as $uti){
			if($uti['idu'] == $selectedId){
				$utis .= '<option value="'.$uti['idu'].'" selected>'.$uti['email'].' - '.$uti['pseudo'].'</option>';
			} else {
				$utis .= '<option value="'.$uti['idu'].'">'.$uti['email'].' - '.$uti['pseudo'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Utilisateurs:</label>
					<select class="form-control" name="utilisateur';
		if($multi){
			$html .= '[]" multiple';
		} else {
			$html .= '"';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseigné--</option>'
						.$utis
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedDestination($disableZero=false, $selectedId=0, $id='', $multi=false) {
		$d = new destination();
		$destinations = $d->getAllDestinations();
		$desti = "";
		
		foreach($destinations as $dest){
			if($dest['idd'] == $selectedId){
				$desti .= '<option value="'.$dest['idd'].'" selected>'.$dest['nom'].'</option>';
			} else {
				$desti .= '<option value="'.$dest['idd'].'">'.$dest['nom'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Destinations:</label>
					<select name="destination" class="form-control"';
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$desti
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedEvent($disableZero=false, $selectedId=0, $id='', $multi=false) {
		$e = new event();
		$d = new destination();
		$u = new utilisateur();
		$events = $e->getAllEvents();
		$even = "";
		
		foreach($events as $ev){
			if($ev['ide'] == $selectedId){
				$even .= '<option value="'.$ev['ide'].'" selected>'.$d->getDestinationById($ev['destination'])['nom'].' par '.$u->getUtilisateurById($ev['createur'])['pseudo'].' le '.date('d/m/Y', $ev['date']).'</option>';
			} else {
				$even .= '<option value="'.$ev['ide'].'">'.$d->getDestinationById($ev['destination'])['nom'].' par '.$u->getUtilisateurById($ev['createur'])['pseudo'].' le '.date('d/m/Y', $ev['date']).'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Trips:</label>
					<select name="event" class="form-control"';
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$even
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedNiveaux($disableZero=false, $selectedId=0, $id='', $multi=false) {
		// Chargement des niveaux et création de la selectbox
		$lvl = $this->getAllNiveaux();
		$niveaux = '';

		foreach($lvl as $lv){
			if($lv['idl'] == $selectedId){
				$niveaux = $niveaux . '<option value="'.$lv['idl'].'" selected>'.$lv['nom'].'</option>';
			} else {
				$niveaux = $niveaux . '<option value="'.$lv['idl'].'">'.$lv['nom'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Niveau:</label>
					<select class="form-control" name="niveau';
		if($multi){
			$html .= '[]" multiple';
		} else {
			$html.='"';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}		
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$niveaux
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedCritere($disableZero=false, $selectedId=0, $id='', $multi=false) {
		$crit = $this->getAllCriteres();
		$criteres = '';
	
		foreach($crit as $cr){
			if($cr['idc'] == $selectedId){
				$criteres .= '<option value="'.$cr['idc'].'" selected>'.$cr['nom'].'</option>';
			} else {
				$criteres .= '<option value="'.$cr['idc'].'">'.$cr['nom'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Critère:</label>
					<select class="form-control" name="critere';
		if($multi){
			$html .= '[]" multiple';
		} else {
			$html .= '"';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$criteres
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedTypeGrimpe($disableZero=false, $selectedId=0, $id='', $multi=false) {
		$types = $this->getAllTypeDeGrimpe();
		$typesGrimpe = '';
		
		foreach($types as $t){
			if($t['idt'] == $selectedId){
				$typesGrimpe .= '<option value="'.$t['idt'].'" selected>'.$t['nom'].'</option>';
			} else {
				$typesGrimpe .= '<option value="'.$t['idt'].'">'.$t['nom'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Type de grimpe:</label>
					<select class="form-control" name="typeDeGrimpe';
		
		if($multi){
			$html .= '[]" multiple';
		} else {
			$html .= '"';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$typesGrimpe
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedCotation($disableZero=false, $selectedId=0, $id='', $multi=false){
		$cotation = $this->getAllCotations();
		$cotations = '';

		foreach($cotation as $c){
			if($c['idcot'] == $selectedId){
				$cotations .= '<option value="'.$c['idcot'].'" selected>'.$c['nom'].'</option>';
			} else {
				$cotations .= '<option value="'.$c['idcot'].'">'.$c['nom'].'</option>';
			}
		}
		
		$html = '';
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$cotations
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedAcces($disableZero=false, $selectedId=0, $id='', $multi=false){
		$a = new acces();
		$listeAcces = $a->getAllAcces();
		$acces = '';

		foreach($listeAcces as $c){
			if($c['ida'] == $selectedId){
				$acces .= '<option value="'.$c['ida'].'" selected>'.$c['nom'].'</option>';
			} else {
				$acces .= '<option value="'.$c['ida'].'">'.$c['nom'].'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Acces*:</label>
					<select name="acces" class="form-control"';
		
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$acces
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedInscription($disableZero=false, $selectedId=0, $id='', $multi=false){
		$i = new inscription();
		$u = new utilisateur();
		$e = new event();
		$d = new destination();
		$listeInscriptions = $i->getAllInscriptions();
		$inscriptions = '';

		foreach($listeInscriptions as $c){
			if($c['idi'] == $selectedId){
				$inscriptions .= '<option value="'.$c['idi'].'" selected>Inscription le '
											.date('d/m/Y', intval($c['date'])) .' de '
											.$u->getUtilisateurById($c['participant'])['pseudo']. ' pour ' 
											.$d->getDestinationById($e->getEventById($c['event'])['destination'])['nom'].' par '
											.$u->getUtilisateurById($e->getEventById($c['event'])['ide'])['pseudo'].' le '
											.date('d/m/Y', $e->getEventById($c['event'])['date']).'</option>';
			} else {
				$inscriptions .= '<option value="'.$c['idi'].'">Inscription le '
											.date('d/m/Y', intval($c['date'])) .' de '
											.$u->getUtilisateurById($c['participant'])['pseudo']. ' pour ' 
											.$d->getDestinationById($e->getEventById($c['event'])['destination'])['nom'].' par '
											.$u->getUtilisateurById($e->getEventById($c['event'])['ide'])['pseudo'].' le '
											.date('d/m/Y', $e->getEventById($c['event'])['date']).'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Inscription*:</label>
					<select name="inscription" class="form-control"';
		
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$inscriptions
					.'</select>';
		return $html;
	}
	
	public function getSelectBoxInitializedInscriptionAnnulee($disableZero=false, $selectedId=0, $id='', $multi=false){
		$i = new inscriptionAnnulee();
		$u = new utilisateur();
		$e = new event();
		$d = new destination();
		$listeInscriptions = $i->getAllInscriptionAnnulees();
		$inscriptions = '';

		foreach($listeInscriptions as $c){
			if($c['idia'] == $selectedId){
				$inscriptions .= '<option value="'.$c['idia'].'" selected>Inscription le '
											.date('d/m/Y', intval($c['date'])) .' de '
											.$u->getUtilisateurById($c['participant'])['pseudo']. ' pour ' 
											.$d->getDestinationById($e->getEventById($c['event'])['destination'])['nom'].' par '
											.$u->getUtilisateurById($e->getEventById($c['event'])['ide'])['pseudo'].' le '
											.date('d/m/Y', $e->getEventById($c['event'])['date']).'</option>';
			} else {
				$inscriptions .= '<option value="'.$c['idia'].'">Inscription le '
											.date('d/m/Y', intval($c['date'])) .' de '
											.$u->getUtilisateurById($c['participant'])['pseudo']. ' pour ' 
											.$d->getDestinationById($e->getEventById($c['event'])['destination'])['nom'].' par '
											.$u->getUtilisateurById($e->getEventById($c['event'])['ide'])['pseudo'].' le '
											.date('d/m/Y', $e->getEventById($c['event'])['date']).'</option>';
			}
		}
		
		$html = '<label for="message-text" class="control-label">Inscription*:</label>
					<select name="inscription" class="form-control"';
		
		if($multi){
			$html .= ' multiple';
		}
		
		if($id != ''){
			$html .= ' id="'.$id.'"';
		}
		
		$html .= '>
						<option value="0"';
		
		if($disableZero){
			$html .= ' disabled';
		}
		
		$html .= '>--Non renseignée--</option>'
						.$inscriptions
					.'</select>';
		return $html;
	}
	
	public function getModalFormulaireCreationCompte($lnkInd) {
		$html = "";
		$html = '		<li>
							<a class="nav-link" data-toggle="modal" data-target="#compteModal" style="cursor:pointer">Créer un Compte</a>
						<!-- Modal -->
<!-- Formulaire de création d un compte par un visiteur -->
						<div class="modal fade" id="compteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Création d\'un compte client</h4>
									</div>
									<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerCompteUtilisateur">
										<div class="modal-body">
											Veuillez renseigner vos informations
											<div class="form-group">
												<label for="recipient-name" class="control-label">Email*:</label>
												<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="recipient-name" name="mail">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Pseudo*:</label>
												<input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" >
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Adresse :</label>
												<textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;"></textarea>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Code Postal :</label>
												<input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Ville :</label>
												<input type="text" class="form-control" id="recipient-name" name="ville">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">N° de téléphone :</label>
												<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel">
											</div>
											<div class="form-group">'
												.$this->getSelectBoxInitializedNiveaux()
											.'</div>
											<div class="form-groupe">
												<label for="message-text" class="control-label">Diplôme :</label>
												<input type="text" class="form-control" id="recipient-name" name="diplome" value="Pas encore prêt." disabled>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Mot de passe*:</label>
												<input type="password" class="form-control" id="recipient-name" name="mdp">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Vérification du mot de passe*:</label>
												<input type="password" class="form-control" id="recipient-name" name="mdpv">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						</li>';
		return $html;
	}
	
	public function getModalFormulaireConnexion($lnkInd) {
		$html = '		<li>
							<a class="nav-link" data-toggle="modal" data-target="#connexionModal" style="cursor:pointer"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Connexion</a>
						</li>
						<!-- Modal -->
<!-- Formulaire de connexion -->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="connexionModal">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Connexion</h4>
									</div>
									<div class="modal-body">
										Veuillez entrer vos informations de compte
										<form method="post" action="'.$lnkInd.'Modele/Connexion.php" id="form_connexion">
											<div class="form-group">
												<label for="recipient-name" class="control-label">Email:</label>
												<input type="email" class="form-control" name="email" id="recipient-name">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Mot de passe:</label>
												<input type="password" class="form-control" id="recipient-name" name="mdp">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button type="submit" class="btn btn-info" >Connexion</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>';
		return $html;
	}
	
	public function getModalFormulaireRecherche($lnkInd, $crit){
		$html = '		<li class="nav-item">
							<a data-toggle="modal" data-target="#dinerModal" style="cursor:pointer">Rechercher un dîner</a>
						</li>
						<!-- Modal -->
<!-- Formulaire de recherche d un diner -->
						<div class="modal fade" id="dinerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Rechercher un dîner</h4>
									</div>
									<form method="post" action="'.$lnkInd.'Vue/recherche.php">
										<div class="modal-body">
											<p><h4>Sélectionnez les critères que vous désirez !</h4></p>
											<div class="input-group">
												<span class="input-group-addon">Nom</span>
												<input name="nom" type="text" class="form-control" placeholder="Nom du dîner" aria-describedby="basic-addon1">
											</div>
											<div class="input-group date">
												<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
												<input id="date" name="date" type="text" class="form-control" data-provide="datepicker">
											</div>
											<div class="input-group">
												<span class="input-group-addon">Lieu</span>
												<textarea name="lieu" type="text" class="form-control" placeholder="Lieu du dîner" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
											</div>
											<div class="input-group">
												<span class="input-group-addon">Prix maximum :</span>
												<input name="prix" class="form-control" type="number" name="prix" min="0" max="1000" step="10" placeholder="Prix du dîner">
											</div>
											<div class="input-group">
												<span class="input-group-addon">Maximum d\'invités:</span >
												<input name = "capa" class="form-control" type = "number" name = "capa" min = "0" max = "200" step = "1" placeholder = "Capacité du diner" >
											</div >
											 <select name = "critere" class="form-control" >
												<option value = "0" selected disabled > Critère</option>'.
												$crit
												.'</select>
											<script>
												$("#date").datepicker({
												    format: \'yyyy-mm-dd\',
                                                    startDate: \'-d\'
												});
											</script>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button class="btn btn-info" type="submit">Recherche</button>
										</div>
									</form>
								</div>
							</div>
						</div>';
		return '';//$html;
	}
	
	public function getModalFormulaireContacterAdmin($lnkInd){
		$html = '		<li class="nav-item">
							<a style="cursor:pointer" data-toggle="modal" data-target="#adminModal" style="cursor:pointer">Contacter un Administrateur</a>
						</li>
						<!-- Modal -->
<!-- Formulaire d envoie de mail à un administrateur -->
						<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="exampleModalLabel">Nouveau Message</h4>
									</div>
									<div class="modal-body">
										<form method="post" action="'.$lnkInd.'Site.php?a=contactAdmin">
											<div class="form-group">
												<label for="recipient-name" class="control-label">Votre mail:</label>
												<input type="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="recipient-name" name="mail">
											</div>
											<div class="form-group">
												<label for="recipient-name" class="control-label">Objet:</label>
												<input type="text" class="form-control" id="recipient-name" name="objet">
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Message:</label>
												<textarea class="form-control" id="message-text" name="msg" style="resize: vertical;" readonly>Cette fonctionnalité est désactivée dûe à un problème technique.</textarea>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button class="btn btn-info" type="submit" disabled>Envoyer</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>';
		return $html;
	}
	
	public function getModalFormulaireCreationEvent($lnkInd, $crit) {
		$html = '			<li class="nav-item">
                                <a style="cursor:pointer" data-toggle="modal" data-target="#proposeModal">Proposer un Dîner</a>
                            </li>
                            <!-- Modal -->
<!-- Formulaire de création d un diner par un Abonné -->
                            <div class="modal fade" id="proposeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Proposer un nouveau diner</h4>
										</div>
										<div class="modal-body">
                                            <form enctype="multipart/form-data" method="post" action="'.$lnkInd.'Site.php?a=creerDiner">
												<div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="'.date('Y-m-d').'">
                                                </div>
												<div class="input-group">
                                                    <span class="input-group-addon">Nom</span>
                                                    <input name="nom" type="text" class="form-control" placeholder="Nom du dîner" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Lieu</span>
                                                    <textarea name="lieu" type="text" class="form-control" placeholder="Lieu du dîner" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Description</span>
                                                    <textarea name="desc" type="text-area" class="form-control" placeholder="Description du dîner" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Prix:</span>
                                                    <input name="prix" class="form-control" type="number" name="prix" min="0" max="1000" step="10" placeholder="Prix du dîner">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Maximum d\'invités:</span >
                                                    <input name = "capa" class="form-control" type = "number" name = "capa" min = "0" max = "200" step = "1" placeholder = "Capacité du diner" >
                                                </div >
                                                <select name = "critere" class="form-control" >
													<option value = "0" selected disabled >Critère</option >'
													.$crit
												.'</select>
												<script>
                                                    $("#date_insert").datepicker({
												    format: \'yyyy-mm-dd\',
                                                    startDate: \'-d\'
												});
                                                </script>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Image : </span>
                                                    <input type="text" id="input_text" class="form-control" name="image" />
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                                    <input name="fichier" type="file" id="fichier_a_uploader" class="input_file" onchange=\'document . getElementById("input_text") . value = this . value\'  />
                                                    <span class="input-group-addon">Parcourir</span>
                                                </div>
                                                <div class="alert alert-warning" role="alert"><small class="alert_info">
                                                    L\'image insérée doit avoir des dimensions inférieures à 5000x5000px et une taille inférieure à 500Mo .</small >
                                                </div >
                                                <div class="modal-footer" >
                                                    <button type = "button" class="btn btn-default" data-dismiss="modal"> Fermer</button >
                                                    <button class="btn btn-info" type = "submit" > Envoyer</button >
                                                </div >
										    </form >
                                        </div>
									</div>
								</div>
                            </div>';
		return '';//$html;
	}
	
	public function getModalMonCompte($lnkInd, $idu) {
		$u = $this->getUtilisateurId($idu);
		$html = '			<li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte <span class="caret"></span></a>
<!-- Menu déroulant d interface de gestion de compte -->
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" data-toggle="modal" data-target="#compteModal" style="cursor:pointer">Mes infos</a></li>
                                    <!--<li><a href="'.$lnkInd.'Vue/mesDiners.php">Mes évenements</a></li>-->
                                    <!--<li><a href="'.$lnkInd.'Vue/mesResa.php">Mes inscriptions</a></li>-->
                                </ul>
                                
                            <!-- Modal -->
<!-- Formulaire de modification des informations du compte connecté -->
                            <div class="modal fade" id="compteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Informations et modification du compte pour : '.$u['email'].'</h4>
										</div>
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireUpdateUtilisateur">
                                            <div class="modal-body">
                                                Modifiez vos informations ici
												<input type="hidden" name="idu" value="'.$idu.'">
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Pseudo*:</label>
                                                <input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" value="'.$u['pseudo'].'" >
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Adresse :</label>
                                                <textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;">'.$u['addresse'].'</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Code Postal :</label>
                                                <input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal" value="'.$u['codePost'].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Ville :</label>
                                                <input type="text" class="form-control" id="recipient-name" name="ville" value="'.$u['ville'].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">N° de téléphone :</label>
                                                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel" value="'.$u['telephone'].'">
                                            </div>
											<div class="form-group">'
												.$this->getSelectBoxInitializedNiveaux(false, $u['niveau'])
											.'</div>
				<!-- Pas encore utilisé -->
											<!--
											<div class="form-group">
                                                <label for="message-text" class="control-label">Solde :</label>
                                                <input type="number" class="form-control" id="recipient-name" name="solde" value="'.$u['solde'].'" disabled>
                                            </div>
											-->
				<!-- Pas Encore implémenté -->
											<div class="form-group">
												<label for="message-text" class="control-label">Vos diplômes :</label> Pas encore dispo
												<!--<input type="text" class="form-control" id"recipient-nam" name="diplome" value="'.$u['diplome'].'" disabled>-->
											</div>
											<!--
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Votre note moyenne d\'invité : '.'5'.' / 5</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Votre note moyenne d\'hote : '.'5'.' / 5</label>
                                            </div>
											-->
											<div class="form-group">
												<label for="message-text" class="control-label">Votre niveau d\'accès : '.$this->getAccesById($u['acces'])['nom'].'
											</div>
                                            <div class="form-group">
												<label for="message-text" class="control-label">Inscrit depuis le : '.date('d/m/Y', $u['dateInscription']).'</label>
											</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button id="bouton" class="btn btn-info" type="submit">Modifier</button>
                                            </div>
                                        </form>
										</br></br>
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireChangerMdp">
											<input type="hidden" name="idu" value="'.$idu.'">
											<div class="form-group">
                                                <label for="message-text" class="control-label">Mot de passe actuel*:</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdpV">
                                            </div>
											<div class="form-group">
                                                <label for="message-text" class="control-label">Nouveau mot de passe*:</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdp1">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Répéter le Nouveau mot de passe*:</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdp2">
                                            </div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button id="bouton" class="btn btn-info" type="submit">Modifier</button>
											</div>
										</form>
                                    </div>
                                </div>
                            </div> 
                            </li>';
		return $html;
	}
	
	public function getModalFormulaireDeconnexion($lnkInd) {
		$html = '			<li>
                                <a class="nav-link" data-toggle="modal" data-target="#DeconnexionModal" style="cursor:pointer"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Déconnexion</a>
                            </li>
                            <!-- Modal -->
<!-- Formulaire de déconnexion -->
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="DeconnexionModal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Deconnexion</h4>
                                        </div>
                                        <div class="modal-body">
                                            Voulez vous vraiment vous deconnecter ?
                                            <form method="post" action="'.$lnkInd.'Modele/Deconnexion.php" id="form_deconnexion">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-info" >Deconnexion</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
		return $html;
	}
	
	public function getModalMenuAdministration($lnkInd) {
		$html = '
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b> </a> 
			<ul class="dropdown-menu">
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Destination</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerDestinationAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierDestinationAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerDestinationAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Type de grimpe</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerTypeDeGrimpeAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierTypeGrimpeAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerTypeGrimpeAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Critère</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerCritereAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierCritereAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerCritereAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Trips</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerEventAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierEventAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerEventAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Inscriptions</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerInscriptionAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#archiverInscriptionAdmin" style="cursor:pointer">Archiver</a></li>
						<li><a data-toggle="modal" data-target="#restaurerInscriptionAdmin" style="cursor:pointer">Restaurer</a></li>
						<li><a data-toggle="modal" data-target="#supprimerInscriptionAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Notes Destinations</a>
					<ul class="dropdown-menu">
						<!--<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Ajouter</a></li>-->
						<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Utilisateur</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerUtilisateurAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierUtilisateurAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerUtilisateurAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Niveau</a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" data-target="#creerNiveauAdmin" style="cursor:pointer">Ajouter</a></li>
						<li><a data-toggle="modal" data-target="#modifierNiveauAdmin" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#supprimerNiveauAdmin" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu"><a tabindex="-1" href="#">Notes Utilisateurs</a>
					<ul class="dropdown-menu">
						<!--<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Ajouter</a></li>-->
						<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Modifier</a></li>
						<li><a data-toggle="modal" data-target="#" style="cursor:pointer">Supprimer</a></li>
					</ul>
				</li>
				
				
				<!--<li><a href="'.$lnkInd.'Vue/modifCompteAdm.php">Modifier un compte utilisateur</a></li>-->
				<!--<li><a data-toggle="modal" data-target="#creerDinerAdm" style="cursor:pointer">Créer un dîner</a></li>-->
				<!--<li><a href="'.$lnkInd.'Vue/modifDinerAdm.php">Modifier un dîner</a></li>-->
				<!--<li class="dropdown-submenu"><a tabindex="-1" href="#">Exemple objet</a>
					<ul class="dropdown-menu">
						<li><a href="#">Ajouter</a></li>
						<li><a href="#">Modifier / Supprimer</a></li>
						<li class="dropdown-submenu"><a href="#">Sous-section</a>
							<ul class="dropdown-menu">
								<li><a href="#">Quatrième niveau</a></li>
								<li class="dropdown-submenu"><a href="#">Sous-section</a>
									<ul class="dropdown-menu">
										<li><a href="#">Cinquième niveau</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>-->
				
			</ul>
		</li>';
		return $html;
	}
	
	//Pour hebergement de la photo
	public function getModalFormulaireCreationEventByAdmin($lnkInd, $crit, $options) {
		$html = '<!-- Modal -->
<!-- Formulaire de creation de diner via admin -->
                            <div class="modal fade" id="creerDinerAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Proposer un nouveau diner</h4>
										</div>
										<div class="modal-body">
                                            <form method="post" action="'.$lnkInd.'Site.php?a=creerDinerAdmin">
											
												<div class="input-group">
													<span class="input-group-addon">Organisateur</span>
													<select class="form-control" name="orga">'.
														$options
													.'</select>
												</div>
												<div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="'.date('Y-m-d').'">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Nom</span>
                                                    <input name="nom" type="text" class="form-control" placeholder="Nom du dîner" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Lieu</span>
                                                    <textarea name="lieu" type="text" class="form-control" placeholder="Lieu du dîner" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Description</span>
                                                    <textarea name="desc" type="text-area" class="form-control" placeholder="Description du dîner" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Prix:</span>
                                                    <input name="prix" class="form-control" type="number" name="prix" min="0" max="1000" placeholder="Prix du dîner">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Maximum d\'invités:</span >
                                                    <input name = "capa" class="form-control" type = "number" name = "capa" min = "0" max = "200" step = "1" placeholder = "Capacité du diner" >
                                                </div >
                                                <select name = "critere" class="form-control" >
                                                    <option value = "0" selected disabled >Critère</option > '.
													$crit
												.'</select><script>
                                                    $("#date_insert").datepicker({
												    format: \'yyyy-mm-dd\',
                                                    startDate: \'-d\'
												});
                                                </script>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Image : </span>
                                                    <input type="text" id="input_text" class="form-control" name="image" />
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                                    <input name="fichier" type="file" id="fichier_a_uploader" class="input_file" onchange=\'document . getElementById("input_text") . value = this . value\'  />
                                                    <span class="input-group-addon">Parcourir</span>
                                                </div>
                                                <div class="alert alert-warning" role="alert"><small class="alert_info">
                                                    L\'image insérée doit avoir des dimensions inférieures à 5000x5000px et une taille inférieure à 500Mo .</small >
                                                </div >
												<div class="modal-footer" >
                                                    <button type = "button" class="btn btn-default" data-dismiss="modal"> Fermer</button >
                                                    <button class="btn btn-info" type = "submit" > Envoyer</button >
                                                </div >
                                            </form >
                                        </div>
									</div>
								</div>
                            </div>';
		return $html;
	}
	
	public function getModalFormulaireCreationCritereAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de création de critère -->
							<div class="modal fade" id="creerCritereAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'un critère</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerCritereAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">
														<label for="message-text" class="control-label">Nom*</label>
														<input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du critère" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Créer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModificationCritereAdmin($lnkInd){
		$html = '<!-- Modal -->
<!-- Formulaire de modification de critère -->
							<div class="modal fade" id="modifierCritereAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modification d\'un critère</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierCritereAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedCritere()
													.'</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Nouveau nom*</label>
														<input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du critère" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionCritereAdmin($lnkInd){
		$c = new critere();
		$allCriteres = $c->getAllCriteres();
		
		$html = '<!-- Modal -->
<!-- Formulaire de modification de critère -->
							<div class="modal fade" id="supprimerCritereAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'un critère</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerCritereAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedCritere(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireCreationDestinationAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de création d une destination par un admin -->
							<div class="modal fade" id="creerDestinationAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerDestinationAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer une destination</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label for="message-text" class="control-label">Nom</label>
													<input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom de la destination*" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Description</label>
                                                    <textarea name="description" type="text-area" class="form-control" id="recipient-name" placeholder="Description de la destination*" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
												<div class="form-group">
													<label for="message-text" class="control-label">Coordonnées GPS*</label>
													<input name="gps" type="text" class="form-control" id="recipient-name" placeholder="Latitude/ Longitude au format 48.735846, 1.923482" aria-describedby="basic-addon1" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedTypeGrimpe()
												.'</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Hauteur du spot*</label >
                                                    <input name = "hauteurDuSpot" class="form-control" id="recipient-name" type = "number" min = "0" max = "1000" step = "1" placeholder = "En mètre." >
                                                </div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Nombre de voies*</label >
                                                    <input name = "nbVoies" class="form-control" id="recipient-name" type = "number" min = "0" max = "1000" step = "1" placeholder = "5" >
                                                </div>
												<div class="form-group">
													<label for="message-text" class="control-label">Cotation Minimum*</label>
													<select name="cotationMin" class="form-control"'
													.$this->getSelectBoxInitializedCotation(true)
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Cotation Maximum*</label>
													<select name="cotationMax" class="form-control"'
													.$this->getSelectBoxInitializedCotation(true)
												.'</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedCritere()
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Pays*</label>
													<input name="pays" type="text" class="form-control" id="recipient-name" placeholder="Pays de la destination" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Région</label>
													<input name="region" type="text" class="form-control" id="recipient-name" placeholder="Région de la destination" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Photo*</label>
													<input name="photo" type="text" class="form-control" id="recipient-name" placeholder="Pas encore prêt" aria-describedby="basic-addon1" disabled>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</form>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModificationDestinationAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification d une destination par un admin -->
							<div class="modal fade" id="modifierDestinationAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierDestinationAdmin" id="formForModifierDestination">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Modifier une destination</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">'
													.$this->getSelectBoxInitializedDestination(false, 0, 'destinationForModifierDestination')
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Nom</label>
													<input name="nom" type="text" class="form-control" id="nomForModifierDestination" placeholder="Nom de la destination*" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Description</label>
                                                    <textarea name="description" type="text-area" class="form-control" id="descriptionForModifierDestination" placeholder="Description de la destination*" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
												<div class="form-group">
													<label for="message-text" class="control-label">Coordonnées GPS*</label>
													<input name="gps" type="text" class="form-control" id="gpsForModifierDestination" placeholder="Latitude/ Longitude au format 48.735846, 1.923482" aria-describedby="basic-addon1" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedTypeGrimpe(true, 0, 'typeGrimpeForModifierDestination')
												.'</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Hauteur du spot*</label >
                                                    <input name = "hauteurDuSpot" class="form-control" id="hauteurSpotForModifierDestination" type = "number" min = "0" max = "1000" step = "1" placeholder = "En mètre." >
                                                </div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Nombre de voies*</label >
                                                    <input name = "nbVoies" class="form-control" id="nombreVoiesForModifierDestination" type = "number" min = "0" max = "1000" step = "1" placeholder = "5" >
                                                </div>
												<div class="form-group">
													<label for="message-text" class="control-label">Cotation Minimum*</label>
													<select name="cotationMin" class="form-control"'
													.$this->getSelectBoxInitializedCotation(true, 0,'cotationMinForModifierDestination')
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Cotation Maximum*</label>
													<select name="cotationMax" class="form-control"'
													.$this->getSelectBoxInitializedCotation(true, 0, 'cotationMaxForModifierDestination')
												.'</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedCritere(false, 0, 'critereForModifierDestination')
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Pays*</label>
													<input name="pays" type="text" class="form-control" id="paysForModifierDestination" placeholder="Pays de la destination" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Région</label>
													<input name="region" type="text" class="form-control" id="regionFormOdifierDestination" placeholder="Région de la destination" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Photo*</label>
													<input name="photo" type="text" class="form-control" id="photoForModifierDestination" placeholder="Pas encore prêt" aria-describedby="basic-addon1" disabled>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<script>
								document.getElementById("destinationForModifierDestination").setAttribute("onChange", "refreshFormDestination()");
								function refreshFormDestination(){
									var idd = document.getElementById("destinationForModifierDestination").value;
									$.ajax({
										url : "'.$lnkInd.'Site.php?a=ajaxForUpdateDestination",
										type : "GET",
										data : "b=" + idd,
										dataType : "json",
										success : function(dataFromDestination, statut){
											if(dataFromDestination == "ERROR"){
												document.getElementById("destinationForModifierDestination").value = "0";
											} else {
												document.getElementById("nomForModifierDestination").setAttribute("value", dataFromDestination["nom"]);
												document.getElementById("descriptionForModifierDestination").innerHTML = dataFromDestination["description"];
												document.getElementById("gpsForModifierDestination").setAttribute("value", dataFromDestination["gps"]);
												document.getElementById("typeGrimpeForModifierDestination").value = dataFromDestination["typeDeGrimpe"];
												document.getElementById("hauteurSpotForModifierDestination").setAttribute("value", dataFromDestination["hauteurDuSpot"]);
												document.getElementById("nombreVoiesForModifierDestination").setAttribute("value", dataFromDestination["nbVoies"]);
												document.getElementById("cotationMinForModifierDestination").value = dataFromDestination["cotationMin"];
												document.getElementById("cotationMaxForModifierDestination").value = dataFromDestination["cotationMax"];
												document.getElementById("critereForModifierDestination").value = dataFromDestination["critere"];
												document.getElementById("paysForModifierDestination").setAttribute("value", dataFromDestination["pays"]);
												document.getElementById("regionFormOdifierDestination").setAttribute("value", dataFromDestination["region"]);
												document.getElementById("photoForModifierDestination").setAttribute("value", dataFromDestination["photo"]);
											}
										}
									});
								}
							</script>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionDestinationAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression de destination -->
							<div class="modal fade" id="supprimerDestinationAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'une destination</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerDestinationAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedDestination(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireCreationTypeDeGrimpeAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de creation de type de grimpe par un admin -->
							<div class="modal fade" id="creerTypeDeGrimpeAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerTypeDeGrimpeAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer un type de grimpe</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label for="message-text" class="control-label">Nom</label>
                                                    <input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du type de grimpe" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
                                                </div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</form>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModificationTypeDeGrimpeAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification d un type de grimpe -->
							<div class="modal fade" id="modifierTypeGrimpeAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modification d\'un type de grimpe</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierTypeDeGrimpeAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedTypeGrimpe(true)
													.'</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Nouveau nom*</label>
														<input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du type de grimpe" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionTypeDeGrimpeAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression d un type de grimpe -->
							<div class="modal fade" id="supprimerTypeGrimpeAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'un type de grimpe</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerTypeDeGrimpeAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedTypeGrimpe(0)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;		
	}
	
	public function getModalFormulaireCreationNiveauAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de creation de niveau par un admin -->
							<div class="modal fade" id="creerNiveauAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerNiveauAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer un niveau</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label for="message-text" class="control-label">Nom</label>
                                                    <input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du niveau" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
                                                </div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</form>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModificationNiveauAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification d un niveau -->
							<div class="modal fade" id="modifierNiveauAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modification d\'un niveau</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierNiveauAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedNiveaux()
													.'</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Nouveau nom*</label>
														<input name="nom" type="text" class="form-control" id="recipient-name" placeholder="Nom du niveau" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionNiveauAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression d un niveau -->
							<div class="modal fade" id="supprimerNiveauAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'un niveau</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerNiveauAdmin">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">'
														.$this->getSelectBoxInitializedNiveaux(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireCreationUtilisateurAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de creation de utilisateur par un admin -->
							<div class="modal fade" id="creerUtilisateurAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerUtilisateurAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer un utilisateur</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="control-label">Email*:</label>
													<input type="email" class="form-control" name="email" id="recipient-name">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Pseudo*:</label>
													<input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedAcces(true)
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Mot de passe*:</label>
													<input type="password" class="form-control" id="recipient-name" name="mdp">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Vérification du mot de passe*:</label>
													<input type="password" class="form-control" id="recipient-name" name="mdpv">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Adresse :</label>
													<textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;"></textarea>
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Code Postal :</label>
													<input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Ville :</label>
													<input type="text" class="form-control" id="recipient-name" name="ville">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">N° de téléphone :</label>
													<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedNiveaux()
												.'</div>
					<!-- Pas encore utilisé -->
												<div class="form-group">
													<label for="message-text" class="control-label">Solde :</label>
													<input type="number" class="form-control" id="recipient-name" name="solde" value="0">
												</div>
					<!-- Pas Encore implémenté -->
												<div class="form-group">
													<label for="message-text" class="control-label">Vos diplômes :</label> Pas encore dispo
													<input type="text" class="form-control" id"recipient-nam" name="diplome" disabled>
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Date d\'inscription :</label>
													<div class="input-group date">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														<input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" min="'.date('m-d-Y').'" placeholder="Cliquer pour choisir" readonly>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</form>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModificationUtilisateurAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification de utilisateur par un admin -->
							<div class="modal fade" id="modifierUtilisateurAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierUtilisateurAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Modifier un utilisateur</h4>
											</div>
											<div class="modal-body">
												<div class="form-group">'
													.$this->getSelectBoxInitializedUtilisateur(false, 0, 'utilisateurForModifierUtilisateur')
												.'</div>
												<div class="form-group">
													<label for="recipient-name" class="control-label">Email*:</label>
													<input type="email" class="form-control" name="email" id="emailForModifierUtilisateur">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Pseudo*:</label>
													<input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="pseudoForModifierUtilisateur" name="pseudo">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedAcces(true, 0, 'accesForModifierUtilisateur')
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Adresse :</label>
													<textarea class="form-control" id="addresseForModifierUtilisateur" name="addresse" style="resize: vertical;"></textarea>
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Code Postal :</label>
													<input type="text" pattern="[0-9]{5}" class="form-control" id="codePostalForModifierUtilisateur" name="codePostal">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Ville :</label>
													<input type="text" class="form-control" id="villeForModifierUtilisateur" name="ville">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">N° de téléphone :</label>
													<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="telForModifierUtilisateur" name="tel">
												</div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedNiveaux(false, 0, 'niveauForModifierUtilisateur')
												.'</div>
					<!-- Pas encore utilisé -->
												<div class="form-group">
													<label for="message-text" class="control-label">Solde :</label>
													<input type="number" class="form-control" id="soldeForModifierUtilisateur" name="solde" value="0">
												</div>
					<!-- Pas Encore implémenté -->
												<div class="form-group">
													<label for="message-text" class="control-label">Vos diplômes :</label> Pas encore dispo
													<input type="text" class="form-control" id"diplomeForModifierUtilisateur" name="diplome" disabled>
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Date d\'inscription :</label>
													<div class="input-group date">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														<input id="dateForModifierUtilisateur" name="date" type="text" class="form-control" data-provide="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" min="'.date('m-d-Y').'" placeholder="Cliquer pour choisir" readonly>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
											</div>
										</form>
										</br></br>
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireChangerMdpAdmin">
											<div class="modal-body">
												<div class="form-group">'
													.$this->getSelectBoxInitializedUtilisateur()
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Nouveau mot de passe*:</label>
													<input type="password" class="form-control" id="recipient-name" name="mdp">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Vérification du mot de passe*:</label>
													<input type="password" class="form-control" id="recipient-name" name="mdpv">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button id="bouton" class="btn btn-info" type="submit">Modifier</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<script>
								document.getElementById("utilisateurForModifierUtilisateur").setAttribute("onChange", "refreshFormUtilisateur()");
								function refreshFormUtilisateur(){
									var id = document.getElementById("utilisateurForModifierUtilisateur").value;
									$.ajax({
										url : "'.$lnkInd.'Site.php?a=ajaxForUpdateUtilisateur",
										type : "GET",
										data : "b=" + id,
										dataType : "json",
										success : function(data, statut){
											if(data == "ERROR"){
												document.getElementById("utilisateurForModifierUtilisateur").value = "0";
											} else {
												var date = new Date(data["dateInscription"]*1000);
												if(date.getMonth()+1 < 10){
													var month = "0" + (date.getMonth()+1);
												} else {
													var month = date.getMonth()+1;
												}
												var nDate = month + "/" + date.getDate() + "/" + date.getFullYear();
												document.getElementById("emailForModifierUtilisateur").setAttribute("value", data["email"]);
												document.getElementById("pseudoForModifierUtilisateur").setAttribute("value", data["pseudo"]);
												document.getElementById("accesForModifierUtilisateur").value = data["acces"];
												document.getElementById("addresseForModifierUtilisateur").setAttribute("value", data["addresse"]);
												document.getElementById("codePostalForModifierUtilisateur").value = data["codePost"];
												document.getElementById("villeForModifierUtilisateur").setAttribute("value", data["ville"]);
												document.getElementById("telForModifierUtilisateur").setAttribute("value", data["telephone"]);
												document.getElementById("niveauForModifierUtilisateur").value = data["niveau"];
												document.getElementById("soldeForModifierUtilisateur").value = data["solde"];
												//document.getElementById("diplomeForModifierUtilisateur").value = data["diplome"];
												document.getElementById("dateForModifierUtilisateur").setAttribute("value", nDate);
											}
										}
									});
								}
							</script>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionUtilisateurAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression d un utilisateur -->
							<div class="modal fade" id="supprimerUtilisateurAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'un utilisateur</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerUtilisateurAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedUtilisateur(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireCreationEventAdmin($lnkInd){
		$html = '<!-- Modal -->
<!-- Formulaire de création d un event par un admin -->
							<div class="modal fade" id="creerEventAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerEventAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer un trip</h4>
											</div>
											<div class="modal-body">
												<div class="form-group" id="divDestinationForCreerEventAdmin">'
													.$this->getSelectBoxInitializedDestination()
												.'</div>
												<div class="form-group" id="divCreateurForCreerEventAdmin">'
													.$this->getSelectBoxInitializedUtilisateur(false, $_SESSION['idu'])
												.'</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Date*:</label>
													<div class="input-group date" id="datepickerForCreerEventAdmin">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														<input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" min="'.date('m-d-Y').'" placeholder="Cliquer pour choisir" readonly>
													</div>
												</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Nombre de place*</label >
                                                    <input name = "nbPlace" class="form-control" id="recipient-name" type = "number" min = "0" max = "1000" step = "1">
                                                </div>
												<div class="form-group">'
													.$this->getSelectBoxInitializedNiveaux(true, 0, 'niveauForCreerEvent', true)
													.'(Maintenez CTRL pour sélectionner plusieurs niveaux)
												</div>
												<div class="form-group">
                                                    <label for="message-text" class="control-label">Description</label>
                                                    <textarea name="description" type="text-area" class="form-control" id="recipient-name" placeholder="Description de la destination" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
												<div class="form-group">
													<input type="checkbox" name="hasLead" id="recipient-name">
													<label for="message-text" class="control-label">Trip guidé</label>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Créer</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								document.getElementById("divCreateurForCreerEventAdmin").firstElementChild.innerHTML = "Créateur*:";
								document.getElementById("divDestinationForCreerEventAdmin").firstElementChild.innerHTML = "Destination*:";
								//$("#datepickerForCreerEventAdmin").data("DateTimePicker").minDate('.date('m-d-Y').');   //Marche pas
							</script>';
		return $html;
	}
	
	public function getModalFormulaireModificationEventAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification d un event par un admin -->
							<div class="modal fade" id="modifierEventAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="post" action="'.$lnkInd.'Site.php?a=formulaireModifierEventAdmin">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aira-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Créer un trip</h4>
											</div>
											<div class="modal-body">
												<div class="form-groupe">'
													.$this->getSelectBoxInitializedEvent(false, 0, 'eventForModifierEvent')
												.'</div>
												<div class="form-group" id="divDestinationForModifierEventAdmin">'
													.$this->getSelectBoxInitializedDestination()
												.'</div>
												<div class="form-group" id="divCreateurForModifierEventAdmin">'
													.$this->getSelectBoxInitializedUtilisateur()
												.'</div>
												<div class="form-group" id="divDateForModifierEventAdmin">
													<label for="message-text" class="control-label">Date*:</label>
													<div class="input-group date" id="datepickerForModifierEventAdmin">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														<input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" min="'.date('m-d-Y').'" placeholder="Cliquer pour choisir" readonly>
													</div>
												</div>
												<div class="form-group" id="divNbPlaceForModifierEventAdmin">
                                                    <label for="message-text" class="control-label">Nombre de place*</label >
                                                    <input name = "nbPlace" class="form-control" id="recipient-name" type = "number" min = "0" max = "1000" step = "1">
                                                </div>
												<div class="form-group" id="divNiveauForModifierEventAdmin">'
													.$this->getSelectBoxInitializedNiveaux(true, 0, '', true)
													.'(Maintenez CTRL pour sélectionner plusieurs niveaux)
												</div>
												<div class="form-group" id="divDescriptionForModifierEventAdmin">
                                                    <label for="message-text" class="control-label">Description</label>
                                                    <textarea name="description" type="text-area" class="form-control" id="recipient-name" placeholder="Description de la destination" aria-describedby="basic-addon1" style="resize: vertical;"></textarea>
                                                </div>
												<div class="form-group" id="divHasLeadForModifierEventAdmin">
													<input type="checkbox" name="hasLead" id="recipient-name">
													<label for="message-text" class="control-label">Trip guidé</label>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												<button id="bouton" class="btn btn-info" type="submit">Modifier</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								document.getElementById("divCreateurForModifierEventAdmin").firstElementChild.innerHTML = "Créateur*:";
								document.getElementById("divDestinationForModifierEventAdmin").firstElementChild.innerHTML = "Destination*:";
								//$("#datepickerForModifierEventAdmin").data("DateTimePicker").minDate('.date('m-d-Y').');   //Marche pas
								
								document.getElementById("eventForModifierEvent").setAttribute("onChange", "refreshFormEvent()");
								function refreshFormEvent(){
									var id = document.getElementById("eventForModifierEvent").value;
									$.ajax({
										url : "'.$lnkInd.'Site.php?a=ajaxForUpdateEvent",
										type : "GET",
										data : "b=" + id,
										dataType : "json",
										success : function(data, statut){
											console.log(data);
											if(data == "ERROR"){
												document.getElementById("eventForModifierevent").value = "0";
											} else {
												var date = new Date(data["date"]*1000);
												if(date.getMonth()+1 < 10){
													var month = "0" + (date.getMonth()+1);
												} else {
													var month = date.getMonth()+1;
												}
												var nDate = month + "/" + date.getDate() + "/" + date.getFullYear();
												var niveaux = data["niveaux"].split(",");
												var optNiv = document.getElementById("divNiveauForModifierEventAdmin").lastElementChild.getElementsByTagName("option");
												for(var opt of optNiv) {
													if(niveaux.includes(opt.value)){
														opt.setAttribute("selected", "");
													} else {
														if(opt.hasAttribute("selected")){
															opt.removeAttribute("selected");
														}	
													}
												}
												
												document.getElementById("divDestinationForModifierEventAdmin").lastElementChild.value = data["destination"];
												document.getElementById("divCreateurForModifierEventAdmin").lastElementChild.value = data["createur"];
												document.getElementById("divDateForModifierEventAdmin").lastElementChild.lastElementChild.setAttribute("value", nDate);
												document.getElementById("divNbPlaceForModifierEventAdmin").lastElementChild.setAttribute("value", data["nbPlace"]);
												document.getElementById("divDescriptionForModifierEventAdmin").lastElementChild.innerHTML = data["description"];
												if(data["hasLead"] == 1){
													document.getElementById("divHasLeadForModifierEventAdmin").firstElementChild.checked = true;
												} else {
													document.getElementById("divHasLeadForModifierEventAdmin").firstElementChild.checked = false;
												}
											}
										}
									});
								}
							</script>';
		return $html;
	}
	
	public function getModalFormulaireSuppressionEventAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression d un event -->
							<div class="modal fade" id="supprimerEventAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Suppression d\'un trip</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerEventAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedEvent(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalCreationInscriptionAdmin($lnkInd){
				$html = '<!-- Modal -->
<!-- Formulaire de création d inscription -->
							<div class="modal fade" id="creerInscriptionAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'une inscription</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireCreerInscriptionAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedUtilisateur()
													.'</div>
													<div class="form-group">'
														.$this->getSelectBoxInitializedEvent()
													.'</div>
													<div class="form-group">
													<label for="message-text" class="control-label">Date de création :</label>
													<div class="input-group date">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														<input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="Cliquer pour choisir" readonly>
													</div>
												</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Créer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalArchivageInscriptionAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de archivage d une inscription -->
							<div class="modal fade" id="archiverInscriptionAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Restauration d\'une inscription</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireRestaurerInscriptionAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedInscription(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Archiver</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalRestaurationInscriptionAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de restauration d une inscription -->
							<div class="modal fade" id="restaurerInscriptionAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Archivage d\'une inscription</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireArchiverInscriptionAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedInscriptionAnnulee(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Restaurer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
		
	public function getModalSuppressionInscriptionAdmin($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression d une inscription -->
							<div class="modal fade" id="supprimerInscriptionAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Archivage d\'une inscription</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=formulaireSupprimerInscriptionAdmin">
												<div class="modal-body">
													<div class="form-group">'
														.$this->getSelectBoxInitializedInscriptionAnnulee(true)
													.'</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-danger" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalScriptForMenuBarre() {
		$html = '
			<script>
                $("#myModal").on("shown.bs.modal", function () {
                    $("#myInput").focus()
                })
            </script>';
		return $html;
	}
	
	public function getModalEnSavoirPlus(){
		$nomBouton = "En savoir plus";
		$titreContentBouton = "Content à remplir";
		$contentBouton = "Content à remplir ? Miaou miaou";
		
		$html = '<p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">'.$nomBouton.'</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">'.$titreContentBouton.'</h4>
                    </div>
                    <div class="modal-body">
                        <p>'.$contentBouton.'</p>
                    </div>
                </div>
            </div>
        </div>';
		return $html;
	}
	
	public function getJumbotron(){
		$titre = "On grimpe ?";
		$sousTitre = "Choisissez votre groupe, choisissez votre grimpe !";
		
		$html = '
			<div class="jumbotron">
				<h1 class="shadow" style="color: #ffffff">'.$titre.'</h1>
				<p class="shadow" style="color: #ffffff">'.$sousTitre.'</p>'
				.$this->getModalEnSavoirPlus()
			.'</div>';
		return $html;
	}
	
	//Fonction utilisée lors de la création d'un compte client depuis la page principale
    public function formulaireCreerCompteUtilisateur(){
		
		//Controles
		$us = $this->getAllUtilisateurs();
		$bool = true;
		$res = '';
		
		if (empty($_POST['mail'])){
			$res .='<div class="alert alert-danger" role="alert">L\'email doit être renseigné.</div>';
			$bool=false;
		} else {
			$emailTMP = strip_tags(htmlentities($_POST['mail']));
			$emailAlreadyexist = false;
			foreach($us as $u){
				if($u['email'] == $emailTMP){
					$res .='<div class="alert alert-danger" role="alert">Cet email est déjà utilisé.</div>';
					$bool = false;
					$emailAlreadyexist = true;
					break;
				}
			}
			if(!$emailAlreadyexist){
				$email = $emailTMP;
			}
		}
		
		if (empty($_POST['pseudo'])) {
            $res.='<div class="alert alert-danger" role="alert">Le pseudo doit être renseigné.</div>';
            $bool=false;
        } else {
            $pseudoTMP = strip_tags(htmlentities($_POST['pseudo']));
			$pseudoAlreadyexist = false;
			foreach($us as $u){
				if($u['pseudo'] == $pseudoTMP){
					$res .='<div class="alert alert-danger" role="alert">Ce pseudo existe déjà.</div>';
					$bool = false;
					$pseudoAlreadyexist = true;
					break;
				}
			}
			if(!$pseudoAlreadyexist){
				$pseudo = $pseudoTMP;
			}
        }

        if (empty($_POST['addresse'])) {
        //    $res.='<div class="alert alert-danger" role="alert">L\'addresse doit être renseigné.</div>';
        //    $bool=false;
			$addresse = '';
		} else {
            $addresse = strip_tags(htmlentities($_POST['addresse']));
        }

        if (empty($_POST['codePostal'])) {
        //    $res.='<div class="alert alert-danger" role="alert">Le codePostal doit être renseigné.</div>';
        //    $bool=false;
			$codePost = '';
        } else {
            $codePost = strip_tags(htmlentities($_POST['codePostal']));
        }

        if (empty($_POST['ville'])) {
        //    $res.='<div class="alert alert-danger" role="alert">La ville doit être renseignée.</div>';
        //    $bool=false;
			$ville = '';
		} else {
            $ville = strip_tags(htmlentities($_POST['ville']));
        }

        if (empty($_POST['tel'])) {
		//	$res.='<div class="alert alert-danger" role="alert">Le téléphone doit être renseigné.</div>';
        //    $bool=false;
			$telephone = '';
        } else {
            $telephone = strip_tags(htmlentities($_POST['tel']));
        }
		
		if(empty($_POST['niveau'])){
		//	$res.='<div class="alert alert-danger" role="alert">Un niveau doit être sélectionné.</div>';
		//	$bool=false;
			$niveau = 0;
		} else {
			$niveau = strip_tags(htmlentities($_POST['niveau']));
		}
		
		if(empty($_POST['diplome'])) {
			$diplome = '';
		} else {
			//A modifier pour gerer l'upload
			$diplome = strip_tags(htmlentities($_POST['diplome']));
		}
		
		if(!empty($_POST['mdp']) && !empty($_POST['mdpv'])){
			$mdp1 = strip_tags(htmlentities($_POST['mdp']));
			$mdp2 = strip_tags(htmlentities($_POST['mdpv']));
			if($mdp1 == $mdp2){
				$mdp = password_hash($mdp1, PASSWORD_BCRYPT);				
			} else {
				$res.='<div class="alert alert-danger" role="alert">Les deux mots de passes ne correspondent pas.</div>';
				$bool=false;
			}
		} else {
			$res .='<div class="alart alert-danger" role="alert">Le mot de passe n\'est pas renseigné.</div>';
			$bool=false;
		}
		
		
		//Fonction d'insert
		if($bool){
			$u = new utilisateur();
			$idu = $u->insertUtilisateur($email, $mdp, $pseudo, $addresse, $codePost, $ville, $telephone, 0, $this->getAccesByNom('Inscrit')['ida'], $niveau, $diplome, time());
			$res.= '<div class="alert alert-success" role="alert">Création du compte effectuée avec succès !</br>Vous pouvez vous connecter dès maintenant.</div>';
		}
		
		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
    }
	
	public function formulaireCreerDestinationAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['nom'])){
			$res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
            $bool=false;
		} else {
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			$d = new destination();
			$dests = $d->getAllDestinations();
			$alreadyExist = false;
			foreach($dests as $dest){
				if($dest['nom'] == $nomTMP){
					$alreadyExist = true;
					$bool=false;
					$res.='<div class="alert alert-danger" role="alert">Ce nom est déjà utilisé.</div>';
					break;
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		if(empty($_POST['description'])){
			$res.='<div class="alert alert-danger" role="alert">La description doit être renseignée.</div>';
            $bool=false;
		} else {
			$description = strip_tags(htmlentities($_POST['description']));
		}
		
		if(empty($_POST['gps'])){
			$res.='<div class="alert alert-danger" role="alert">Les coordonnées GPS doivent être renseignées.</div>';
            $bool=false;
		} else {
			//REGEX à utilisé ^([-+]?)([\d]{1,2})(((\.)(\d+)(/)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$
			$gps = strip_tags(htmlentities($_POST['gps']));
		}
		
		if(empty($_POST['typeDeGrimpe'])){
			$res.='<div class="alert alert-danger" role="alert">Un type de grimpe doit être choisi.</div>';
            $bool=false;
		} else {
			$typeDeGrimpe = strip_tags(htmlentities($_POST['typeDeGrimpe']));
		}
		
		if(empty($_POST['hauteurDuSpot'])){
			$res.='<div class="alert alert-danger" role="alert">La hauteur du spot doit être renseignée.</div>';
            $bool=false;
		} else {
			$hauteurDuSpot = strip_tags(htmlentities($_POST['hauteurDuSpot']));
		}
		
		if(empty($_POST['nbVoies'])){
			$res.='<div class="alert alert-danger" role="alert">Le nombre de voie doit être renseigné.</div>';
            $bool=false;
		} else {
			$nbVoies = strip_tags(htmlentities($_POST['nbVoies']));
		}
		
		if(empty($_POST['cotationMin'])){
			$res.='<div class="alert alert-danger" role="alert">La cotation minimal doit être indiquée.</div>';
            $bool=false;
		} else {
			$cotationMin = strip_tags(htmlentities($_POST['cotationMin']));
		}
		
		if(empty($_POST['cotationMax'])){
			$res.='<div class="alert alert-danger" role="alert">La cotation maximal doit être indiquée.</div>';
            $bool=false;
		} else {
			$cotationMaxTMP = strip_tags(htmlentities($_POST['cotationMax']));
			if(isset($cotationMin)){
				if(intval($cotationMin)<=intval($cotationMaxTMP)){
					$cotationMax = $cotationMaxTMP;
				} else {
					$res.='<div class="alert alert-danger" role="alert">La cotation maximal doit être supérieure ou égale à la minimal.</div>';
					$bool=false;
				}
			}			
		}
		
		if(empty($_POST['critere'])){
			//$res.='<div class="alert alert-danger" role="alert">Un critère doit être choisi.</div>';
			//$bool=false;
			$critere = 0;
		} else {
			$critere = strip_tags(htmlentities($_POST['critere']));
		}

		if(empty($_POST['pays'])){
			$res.='<div class="alert alert-danger" role="alert">Le pays doit être renseigné.</div>';
            $bool=false;
		} else {
			$pays = strip_tags(htmlentities($_POST['pays']));
		}
		
		if(empty($_POST['region'])){
			//$res.='<div class="alert alert-danger" role="alert">La région doit être renseignée.</div>';
            //$bool=false;
			$region = '';
		} else {
			$region = strip_tags(htmlentities($_POST['region']));
		}
		
		if(empty($_POST['photo'])){
			//$res.='<div class="alert alert-danger" role="alert">Une photo du spot doit être fournie.</div>';
            //$bool=false;
			$photo = '';
		} else {
			$photo = strip_tags(htmlentities($_POST['photo']));
		}
		
		//Fonction d'insert
		if($bool){
			$d = new destination();
			$idd = $d->insertDestination($nom, $description, $gps, $critere, $typeDeGrimpe, $hauteurDuSpot, $nbVoies, $cotationMin, $cotationMax, $pays, $region, $photo);
			$res .= '<div class="alert alert-success" role="alert">Création de la destination réussie. ID de la nouvelle destination : '.$idd.'</div>';
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireModifierDestinationAdmin(){
		$dest = new destination();
		$bool = true;
		$res = '';
		
		if($_POST['destination'] == 0){
			$res .= '<div class="alert alert-danger" role="alert">La destination doit être choisi.</div>';
			$bool=false;
		} else {
			$idd = strip_tags(htmlentities($_POST['destination']));
			$d = $dest->getDestinationById($idd);
		
			//Controles
			if(empty($_POST['nom'])){
				//$res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
				//$bool=false;
				$nom = $d['nom'];
			} else {
				$nom = strip_tags(htmlentities($_POST['nom']));
			}
			
			if(empty($_POST['description'])){
				//$res.='<div class="alert alert-danger" role="alert">La description doit être renseignée.</div>';
				//$bool=false;
				$description = $d['description'];
			} else {
				$description = strip_tags(htmlentities($_POST['description']));
			}
			
			if(empty($_POST['gps'])){
				//$res.='<div class="alert alert-danger" role="alert">Les coordonnées GPS doivent être renseignées.</div>';
				//$bool=false;
				$gps = $d['gps'];
			} else {
				//REGEX à utilisé ^([-+]?)([\d]{1,2})(((\.)(\d+)(/)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$
				$gps = strip_tags(htmlentities($_POST['gps']));
			}
			
			if(empty($_POST['typeDeGrimpe'])){
				//$res.='<div class="alert alert-danger" role="alert">Un type de grimpe doit être choisi.</div>';
				//$bool=false;
				$typeDeGrimpe = $d['typeDeGrimpe'];
			} else {
				$typeDeGrimpe = strip_tags(htmlentities($_POST['typeDeGrimpe']));
			}
			
			if(empty($_POST['hauteurDuSpot'])){
				//$res.='<div class="alert alert-danger" role="alert">La hauteur du spot doit être renseignée.</div>';
				//$bool=false;
				$hauteurDuSpot = $d['hauteurDuSpot'];
			} else {
				$hauteurDuSpot = strip_tags(htmlentities($_POST['hauteurDuSpot']));
			}
			
			if(empty($_POST['nbVoies'])){
				//$res.='<div class="alert alert-danger" role="alert">Le nombre de voie doit être renseigné.</div>';
				//$bool=false;
				$nbVoies = $d['nbVoies'];
			} else {
				$nbVoies = strip_tags(htmlentities($_POST['nbVoies']));
			}
			
			if(empty($_POST['cotationMin'])){
				//$res.='<div class="alert alert-danger" role="alert">La cotation minimal doit être indiquée.</div>';
				//$bool=false;
				$cotationMin = $d['cotationMin'];
			} else {
				$cotationMin = strip_tags(htmlentities($_POST['cotationMin']));
			}
			
			if(empty($_POST['cotationMax'])){
				//$res.='<div class="alert alert-danger" role="alert">La cotation maximal doit être indiquée.</div>';
				//$bool=false;
				$cotationMax = $d['cotationMax'];
			} else {
				$cotationMaxTMP = strip_tags(htmlentities($_POST['cotationMax']));
				if(isset($cotationMin)){
					if(intval($cotationMin)<=intval($cotationMaxTMP)){
						$cotationMax = $cotationMaxTMP;
					} else {
						$res.='<div class="alert alert-danger" role="alert">La cotation maximal doit être supérieure ou égale à la minimal.</div>';
						$bool=false;
					}
				}			
			}
			
			if(empty($_POST['critere'])){
				//$res.='<div class="alert alert-danger" role="alert">Un critère doit être choisi.</div>';
				//$bool=false;
				$critere = $d['critere'];
			} else {
				$critere = strip_tags(htmlentities($_POST['critere']));
			}

			if(empty($_POST['pays'])){
				//$res.='<div class="alert alert-danger" role="alert">Le pays doit être renseigné.</div>';
				//$bool=false;
				$pays = $d['pays'];
			} else {
				$pays = strip_tags(htmlentities($_POST['pays']));
			}
			
			if(empty($_POST['region'])){
				//$res.='<div class="alert alert-danger" role="alert">La région doit être renseignée.</div>';
				//$bool=false;
				$region = $d['region'];
			} else {
				$region = strip_tags(htmlentities($_POST['region']));
			}
			
			if(empty($_POST['photo'])){
				//$res.='<div class="alert alert-danger" role="alert">Une photo du spot doit être fournie.</div>';
				//$bool=false;
				//$photo = $d['photo'];
				$photo = '';
			} else {
				$photo = strip_tags(htmlentities($_POST['photo']));
			}
			
			//Fonction d'update
			if($bool){
				$c = new destination();
				$result = $c->updateDestination($idd, $nom, $description, $gps, $critere, $typeDeGrimpe, $hauteurDuSpot, $nbVoies, $cotationMin, $cotationMax, $pays, $region, $photo);
				if($result == 1){
					$res .= '<div class="alert alert-success" role="alert">Modification de la destination réussie.</div>';
				} else {
					$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
				}
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerDestinationAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['destination'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Une destination doit être sélectionnée.</div>';
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['destination']));
		}
		
		//Fonction d'insert
		if($bool){
			$c = new destination();
			$idc = $c->deleteDestination($idt);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression de la destination réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
    //Fonction utilisée lors de la création d'un diner par un administrateur
    //L'organisateur de ce diner est choisit parmis les comptes existants
    public function creerDinerAdmin(){
		// Chargement de la barre de navigation
        session_start();
        $barre = "barreVisiteur";
        if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
        {
            $grade=$_SESSION['acces'];
            $id=$_SESSION['idu'];

            switch($grade) {
                case "Abonne":
                    $barre = "barreAbonne";
                    break;
                case "Administrateur":
                    $barre = "barreAdmin";
                    break;
            }
        }else{
            if(isset($grade))
                unset($grade);
        }

        // Début des vérifications de tous les paramètres.
        $bool=true;
        $res='';
        if (empty($_POST['date'])) {
            $res.='<div class="alert alert-danger" role="alert">La date doit être choisie.</div>';
            $bool=false;
        } else {
            $date = strip_tags(htmlentities($_POST['date']));
        }

        if (empty($_POST['nom'])) {
            $res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
            $bool=false;
        } else {
            $nom = strip_tags(htmlentities($_POST['nom']));
        }

        if (empty($_POST['lieu'])) {
            $res.='<div class="alert alert-danger" role="alert">Le lieu doit être renseigné.</div>';
            $bool=false;
        } else {
            $lieu = strip_tags(htmlentities($_POST['lieu']));
        }

        if (empty($_POST['desc'])) {
            $res.='<div class="alert alert-danger" role="alert">La description doit être complétée.</div>';
            $bool=false;
        } else {
            $desc = strip_tags(htmlentities($_POST['desc']));
        }

        if (empty($_POST['prix'])) {
            $res.='<div class="alert alert-danger" role="alert">Le prix doit être renseigné.</div>';
            $bool=false;
        } else {
            $prix = strip_tags(htmlentities($_POST['prix']));
        }

        if (empty($_POST['capa'])) {
            $res.='<div class="alert alert-danger" role="alert">La capacité doit être renseignée.</div>';
            $bool=false;
        } else {
            $capa = strip_tags(htmlentities($_POST['capa']));
        }

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Création effectuée avec succès !</div>';
            $d = new diner();
            $d->insert($_POST['orga'], $nom, $lieu, $desc, $prix, $date, $capa);
        }

        //Affichage
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
	<link type="text/Css" href="Css/menuBarre.Css" rel="stylesheet" />
    <link type="text/Css" href="Css/index.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/dist/Css/bootstrap.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/datepicker/Css/datepicker.Css" rel="stylesheet"/>
    <link type="text/Css" href="./slider/Css/slider.Css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>

</head>
<body id="body">';

        $v = new menuBarre();
        echo $v->affichage($barre);

        echo '<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">Besoin d\'un dîner?</h1>
        <p class="shadow" style="color: #ffffff">Ce site vous propose de rechercher des dîners près de chez vous rapidement !</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">En savoir plus</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Partage de diners en ligne</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ce site web a été développé dans le cadre d\'un projet universitaire, au cours du M1 MIAGE à l\'Université Paris-Sud.</p>
                        <p>Il a pour but de faciliter le partage de diners entre particuliers en proposant deux fonctionnalités, très simples d\'utilisation.</p>
                        <p>Ainsi, vous pouvez proposer un dîner, organisé par vos soins, ou rechercher un dîner auquel participer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" role="alert">
        L\'insertion de votre dîner a été effectué avec
        <a href="#" class="alert-link">Succès !</a>
    </div>';
    }
	
	// Fonction permettant de s'inscrire à un diner
    public function participer(){

        $f = new FuncController();
        $bool = $f->justDoIt($_POST['idu'],$_POST['idd'],$_POST['date'],$_POST['prix']);
        $utilisateur = $f->getSolde($_POST['idu']);
        session_start();
        $barre = "barreVisiteur";
        if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
        {
            $grade=$_SESSION['acces'];
            $id=$_SESSION['idu'];

            switch($grade) {
                case "Abonne":
                    $barre = "barreAbonne";
                    break;
                case "Administrateur":
                    $barre = "barreAdmin";
                    break;
            }
        }else{
            if(isset($grade))
                unset($grade);
        }
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
	<link type="text/Css" href="Css/menuBarre.Css" rel="stylesheet" />
    <link type="text/Css" href="Css/index.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/dist/Css/bootstrap.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/datepicker/Css/datepicker.Css" rel="stylesheet"/>
    <link type="text/Css" href="./slider/Css/slider.Css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>

</head>
<body id="body">';

        $v = new menuBarre();
        echo $v->affichage($barre);

        echo '<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">Besoin d\'un dîner?</h1>
        <p class="shadow" style="color: #ffffff">Ce site vous propose de rechercher des dîners près de chez vous rapidement !</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">En savoir plus</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Partage de diners en ligne</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ce site web a été développé dans le cadre d\'un projet universitaire, au cours du M1 MIAGE à l\'Université Paris-Sud.</p>
                        <p>Il a pour but de faciliter le partage de diners entre particuliers en proposant deux fonctionnalités, très simples d\'utilisation.</p>
                        <p>Ainsi, vous pouvez proposer un dîner, organisé par vos soins, ou rechercher un dîner auquel participer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        if($bool) {
            echo '<div class="alert alert-success" role="alert">
                    <a class="alert-link">Félicitation!</a> Vous participez à ce diner.
                    Votre nouveau solde est de <a class="alert-link">'.$utilisateur[0]['solde'].'</a>
                  </div>';
        }
        else{
            echo '<div class="alert alert-warning" role="alert">
                    <a href="#" class="alert-link">Attention!</a> Votre solde est insuffisant. Pensez à le recharger.
                    <table id="table" class="table-condensed">
                        <tr>
                            <th>Votre Solde</th>
                            <th>Prix</th>
                        </tr>
                        <tr>
                            <td>'.$utilisateur[0]['solde'].'€</td>
                            <td>'.$_POST['prix'].'€</td>
                        </tr>
                    </table>
                  </div>';
        }
    }
	
	// Fonction permettant à un utilisateur de donner une note à un diner
	public function noterDiner(){
		// Chargement de la barre de navigation
		session_start();
        $barre = "barreVisiteur";
        if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
        {
            $grade=$_SESSION['acces'];
            $id=$_SESSION['idu'];

            switch($grade) {
                case "Abonne":
                    $barre = "barreAbonne";
                    break;
                case "Administrateur":
                    $barre = "barreAdmin";
                    break;
            }
        }else{
            if(isset($grade))
                unset($grade);
        }
		
		// Début des vérifications de tous les paramètres.
        $bool=true;
        $res='';
		$idd = $_POST['diner'];
		if (empty($_POST['note'])) {
            $res.='<div class="alert alert-danger" role="alert">Une note doit être donnée.</div>';
            $bool=false;
        } else {
            $note = strip_tags(htmlentities($_POST['note']));
        }
		
		$d = $this->getInfoDinerByIdd($idd);
		$idu_Hot = $d->idu;
		
		// Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Notation effectuée avec succès !</div>';
            $nH = new noteHote();
            $nH->insert($idd, $idu_Hot, $id, $note);
        }

        //Affichage
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
	<link type="text/Css" href="Css/menuBarre.Css" rel="stylesheet" />
    <link type="text/Css" href="Css/index.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/dist/Css/bootstrap.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/datepicker/Css/datepicker.Css" rel="stylesheet"/>
    <link type="text/Css" href="./slider/Css/slider.Css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>

</head>
<body id="body">';

        $v = new menuBarre();
        echo $v->affichage($barre);

        echo '<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">Besoin d\'un dîner?</h1>
        <p class="shadow" style="color: #ffffff">Ce site vous propose de rechercher des dîners près de chez vous rapidement !</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">En savoir plus</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Partage de diners en ligne</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ce site web a été développé dans le cadre d\'un projet universitaire, au cours du M1 MIAGE à l\'Université Paris-Sud.</p>
                        <p>Il a pour but de faciliter le partage de diners entre particuliers en proposant deux fonctionnalités, très simples d\'utilisation.</p>
                        <p>Ainsi, vous pouvez proposer un dîner, organisé par vos soins, ou rechercher un dîner auquel participer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" role="alert">
        L\'insertion de votre dîner a été effectué avec
        <a href="#" class="alert-link">Succès !</a>
    </div>';
	}
	
    //Fonction utilisée pour obtenir l'ensemble des comptes existants
    public function getAllUtilisateurs(){
        $u = new utilisateur();
        return $u->getAllUtilisateurs();
    }	
	
	// Fonction permettant de récupérer les infos d'un compte donné
	public function getUtilisateurId($idu){
		$u = new utilisateur();
		$info = $u->getUtilisateurById($idu);
		return $info;
	}

	// Fonction permettant de récupérer les infos d'un diner donné
	public function getInfoDinerByIdd($idd) {
	/*	$d = new diner();
		return $d->getInfosDiner($idd);*/
	}

	// Fonction permettant de récupérer les infos de tous les diners à venir d'un hote donné
	public function getAllDinerAvenirByIdu($idu) {
	/*	$d = new diner();
		return $d->getDinersAvenir($idu);*/
	}
	
	// Fonction permettant de récupérer les infos de tous les diners passés pour un hote donné
	public function getHistoDinerByIdu($id){
	/*	$d = new diner();
		return $d->getHistoDiners($id);*/
	}

	// Fonction utilisée pour la recherche de diner
	// Les vérifications de formulaires se font dans le fichier Modele/diner.php
    public function rechercherDiner($idu,$nom,$date,$prix,$capa,$critere,$lieu){
    /*    $d = new diner();
        return $d->rechercher($idu,$nom,$date,$prix,$capa,$critere,$lieu);*/
    }

	// Fonction permettant d'obtenir le nombre de participants à un diner donné
	public function getNbParticipantsByIdd($id){
	/*	$r = new reservation();
		return $r->getNbParticipants($id);*/
	}
	
	// Fonction permettant de récupérer les informations des réservations en cours d'un compte donné
	public function getResaEnCoursByIdu($id){
	/*	$r = new reservation();
		return $r->getResaEnCours($id);*/
	}
	
	// Fonction permettant de récupérer les informations des réservations passées d'un compte donné
	public function getHistoResaByIdu($id){
	/*	$r = new reservation();
		return $r->getHistoResa($id);*/
	}
	
	// Fonction permettant de récupérer la note moyenne d'hote d'un compte donné
	public function getNoteMoyenneHoteByIdu($id){
	/*	$nh = new noteHote();
		return $nh->getMoyenneHote($id);*/
	}
	
	// Fonction permettant de récupérer la note moyenne d'hote pour un diner donné
	public function getNoteMoyenneHoteByIdd($id){
	/*	$nh = new noteHote();
		return $nh->getMoyenneDiner($id);*/
	}
	
	// Fonction permettant de récupérer la note moyenne d'invité d'un compte donné
	public function getNoteMoyenneInviteByIdu($id){
	/*	$ni = new noteInvite();
		return $ni->getMoyenneInvite($id);*/
	}
	
	// Fonction permettant de récupérer la note d'invité d'un compte pour un diner donné
	public function getNoteInviteByIdd($idu, $idd){
	/*	$ni = new noteInvite();
		return $ni->getNoteInvite($idu, $idd);*/
	}
	
	// Fonction permettant de savoir si un diner a déjà été noté par un utilisateur
	public function dinerDejaNote($idd, $idu){
	/*	$nH = new noteHote();
		return $nH->getAlreadyNoted($idd, $idu);*/		
	}
    
	// Fonction permettant à un administrateur de modifier un compte
	public function modifCompteAdmin(){
	// Chargement de la barre de navigation
    /*session_start();
    $barre = "barreVisiteur";
    if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
    {
        $grade=$_SESSION['acces'];
        $id=$_SESSION['idu'];

        switch($grade) {
            case "Abonne":
                $barre = "barreAbonne";
                break;
            case "Administrateur":
                $barre = "barreAdmin";
                break;
        }
    }else{
        if(isset($grade))
            unset($grade);
    }

        // Début des vérifications de tous les paramètres. 
        $u = new utilisateur();
        $bool=true;
        $res='';
        if (empty($_POST['nom'])) {
            $res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
            $bool=false;
        } else {
            $nom = strip_tags(htmlentities($_POST['nom']));
        }

        if (empty($_POST['prenom'])) {
            $res.='<div class="alert alert-danger" role="alert">Le prenom doit être renseigné.</div>';
            $bool=false;
        } else {
            $prenom = strip_tags(htmlentities($_POST['prenom']));
        }

        if (empty($_POST['addresse'])) {
            $res.='<div class="alert alert-danger" role="alert">L\'addresse doit être renseigné.</div>';
            $bool=false;
        } else {
            $addr = strip_tags(htmlentities($_POST['addresse']));
        }

        if (empty($_POST['codePostal'])) {
            $res.='<div class="alert alert-danger" role="alert">Le codePostal doit être renseigné.</div>';
            $bool=false;
        } else {
            $cp = strip_tags(htmlentities($_POST['codePostal']));
        }

        if (empty($_POST['ville'])) {
            $res.='<div class="alert alert-danger" role="alert">La ville doit être renseignée.</div>';
            $bool=false;
        } else {
            $ville = strip_tags(htmlentities($_POST['ville']));
        }

        if (empty($_POST['tel'])) {
            $res.='<div class="alert alert-danger" role="alert">Le téléphone doit être renseigné.</div>';
            $bool=false;
        } else {
            $tel = strip_tags(htmlentities($_POST['tel']));
        }
		
		$idu = $_POST['idu'];
       	$acces = $_POST['acces'];
        

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Modification de compte effectuée avec succès !</div>';
            $u->updateInfosClientNoMailAdmin($idu, $nom, $prenom, $addr, $cp, $ville, $tel, $acces);
            if (empty($_POST['mdp1'])) {
                $res.='<div class="alert alert-danger" role="alert">Le mot de passe est inchangé.</div>';
                } else {
                    if($_POST['mdp1'] == $_POST['mdp2']){
                        $mdp = strip_tags(htmlentities($_POST['mdp1']));
                        $u->updateMdpClient($idu, $mdp);
                        $res.= '<div class="alert alert-success" role="alert">Modification de mot de passe effectuée avec succès !</div>';
                    }
                    else{
                        $res.='<div class="alert alert-danger" role="alert">Les deux mots de passes ne correspondent pas. Pas de changement de mot de passe.</div>';
                    }

                }
        }

        // On affiche la page de retour
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
    <link type="text/Css" href="Css/menuBarre.Css" rel="stylesheet" />
    <link type="text/Css" href="Css/index.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/dist/Css/bootstrap.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/datepicker/Css/datepicker.Css" rel="stylesheet"/>
    <link type="text/Css" href="./slider/Css/slider.Css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>

</head>
<body id="body">';

$v = new menuBarre();
echo $v->affichage($barre);

echo '<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">Besoin d\'un dîner?</h1>
        <p class="shadow" style="color: #ffffff">Ce site vous propose de rechercher des dîners près de chez vous rapidement !</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">En savoir plus</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Partage de diners en ligne</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ce site web a été développé dans le cadre d\'un projet universitaire, au cours du M1 MIAGE à l\'Université Paris-Sud.</p>
                        <p>Il a pour but de faciliter le partage de diners entre particuliers en proposant deux fonctionnalités, très simples d\'utilisation.</p>
                        <p>Ainsi, vous pouvez proposer un dîner, organisé par vos soins, ou rechercher un dîner auquel participer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" role="alert">
    '.$res.'
    </div>';*/
    }
	
	// Fonction permettant à un abonné de modifier un de ses diner
    public function modifierDiner($p){

        $msgErreur="";
        $d = new diner();
        $d = $d->getInfosDiner(strip_tags(htmlentities($p['idd'])));

/////////////////////////////////////////////////////////////////////////////////////////////////
//   BEURK    //
        if(empty($_POST['nom'])){
            $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
            $msgErreur =  $msgErreur . "Le nom doit être renseigné <br/>";
            $erreur=0;
        }
        else{
            $d->nom=strip_tags(htmlentities($_POST['nom']));
        }

        if(empty($_POST['descr'])){
            $d->desc = "Aucune description";
        }
        else{
            $d->desc=strip_tags(htmlentities($_POST['descr']));
        }

        if(empty($_POST['capa'])){
            $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
            $msgErreur =  $msgErreur . "La capacité doit être renseignée <br/>";
            $erreur=0;
        }
        else{
            $d->capacite=strip_tags(htmlentities($_POST['capa']));
        }
////////////////////////////////////////////////////////////////////////////////////////////////
        $rep = $d->updateDiner($d);

        if ($rep > 0){
            $message = 'Le diner n°'.$d->idd.' a bien été modifié.';
        }
        else {
            $message = '<span class=\"titre\">Erreur ...</span><br/>'.'Le diner n°'.$d->idd.' n\'a pas pu être modifié.<br/>'. $msgErreur;
            $message .= $d->nom ." ".$d->desc." ".$d->capacite." ".$d->idd;
        }
        header('Location:./Vue/mesDiners.php?message='.$message);
    }

	// Fonction permettant à un administrateur de modifier un diner
    public function modifDinerAdmin(){
		// Chargement de la barre de navigation
		session_start();
        $barre = "barreVisiteur";
        if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
        {
            $grade=$_SESSION['acces'];
            $id=$_SESSION['idu'];

            switch($grade) {
                case "Abonne":
                    $barre = "barreAbonne";
                    break;
                case "Administrateur":
                    $barre = "barreAdmin";
                    break;
            }
        }else{
            if(isset($grade))
                unset($grade);
        }

        // Début des vérifications de tous les paramètres.
        $bool=true;
        $res='';
		$idu = $_POST['idu'];
		$idd = $_POST['idd'];
		
        if (empty($_POST['date'])) {
            $res.='<div class="alert alert-danger" role="alert">La date doit être choisie.</div>';
            $bool=false;
        } else {
            $date = strip_tags(htmlentities($_POST['date']));
        }

        if (empty($_POST['nom'])) {
            $res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
            $bool=false;
        } else {
            $nom = strip_tags(htmlentities($_POST['nom']));
        }

        if (empty($_POST['lieu'])) {
            $res.='<div class="alert alert-danger" role="alert">Le lieu doit être renseigné.</div>';
            $bool=false;
        } else {
            $lieu = strip_tags(htmlentities($_POST['lieu']));
        }

        if (empty($_POST['desc'])) {
            $res.='<div class="alert alert-danger" role="alert">La description doit être complétée.</div>';
            $bool=false;
        } else {
            $desc = strip_tags(htmlentities($_POST['desc']));
        }

        if (empty($_POST['prix'])) {
            $res.='<div class="alert alert-danger" role="alert">Le prix doit être renseigné.</div>';
            $bool=false;
        } else {
            $prix = strip_tags(htmlentities($_POST['prix']));
        }

        if (empty($_POST['capa'])) {
            $res.='<div class="alert alert-danger" role="alert">La capacité doit être renseignée.</div>';
            $bool=false;
        } else {
            $capa = strip_tags(htmlentities($_POST['capa']));
        }
		
		// Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Modifications effectuée avec succès !</div>';
            $d = new diner();
			
			$d->idd = $idd;
			$d->idu = $idu;
			$d->nom = $nom;
			$d->date = $date;
			$d->lieu = $lieu;
			$d->desc = $desc;
			$d->prix = $prix;
			$d->capacite = $capa;
			$d->critere = $_POST['critere'];
            $d->updateDinerAdmin($d);
        }

        if (empty($_POST['image'])) {
           $message = '';
        } else {
            $image = strip_tags(htmlentities($_POST['image']));

            //>>>>>>>>>>>>>>>>>>>>>>>> SCRIPT VERIFICATION IMAGE <<<<<<<<<<<<<<<<<<<<<<<<<<<<

            define('TARGET', $_SERVER['DOCUMENT_ROOT'] . '/ter/Images/'); // Repertoire cible
            define('MAX_SIZE', 500000); // Taille max en octets du fichier
            define('WIDTH_MAX', 5000); // Largeur max de l'image en pixels
            define('HEIGHT_MAX', 5000); // Hauteur max de l'image en pixels
            // Tableaux de donnees
            $tabExt = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
            $infosImg = array();
            // Variables
            $extension = '';
            $nomImage = '';
            /************************************************************
             * Creation du repertoire cible si inexistant
             *************************************************************/
            if (!is_dir(TARGET)) {
                if (!mkdir(TARGET, 0755)) {
                    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
                }
            }
            /************************************************************
             * Script d'upload
             *************************************************************/

            if (!empty($_POST['image'])) {
// On verifie si le champ est rempli
                if (!empty($_FILES['fichier']['name'])) {
// Recuperation de l'extension du fichier
                    $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
// On verifie l'extension du fichier
                    if (in_array(strtolower($extension), $tabExt)) {
// On recupere les dimensions du fichier
                        $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
// On verifie le type de l'image
                        if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
// On verifie les dimensions et taille de l'image
                            if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
// Parcours du tableau d'erreurs
                                if (isset($_FILES['fichier']['error'])
                                    && UPLOAD_ERR_OK === $_FILES['fichier']['error']
                                ) {
// On nomme le fichier
                                    $nomImage = basename(strip_tags(htmlentities($_POST['image'])));
//On verifie qu'aucun fichier du même nom existe
                                    if (!file_exists(TARGET . $nomImage)) {
// Si c'est OK, on teste l'upload
                                        if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {
                                            move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage);
                                            $image = 'Images/' . $nomImage;
                                            $message = 'L\'opération a été effectuée avec succès!';
                                        } else {
// Sinon on affiche une erreur systeme
                                            $message = 'Problème lors de l\'enregistrement de l\'image !';
                                            $message .= '<br/>L\'enregistrement de l\'image n\'a donc pas été pris en compte.';
                                            $bool=false;
                                        }
                                    } else {
                                        $image = 'Images/' . $nomImage;
                                        $message = 'L\'image <strong>'.$nomImage.'</strong> existe déjà. Veuillez modifier le nom du fichier.';
                                        $message .= '<br/>L\'enregistrement de l\'image n\'a donc pas été pris en compte.';
                                        $bool=false;
                                    }
                                } else {
                                    $message = 'Une erreur interne a empêché l\'enregistrement de l\'image';
                                    $message .= '<br/>L\'enregistrement de l\'image n\'a donc pas été pris en compte.';
                                    $bool=false;
                                }
                            } else {
// Sinon erreur sur les dimensions et taille de l'image
                                $message = 'Erreur dans les dimensions de l\'image !';
                                $message .= '<br/>L\'enregistrement de l\'image n\'a donc pas été pris en compte.';
                                $bool=false;
                            }
                        } else {
// Sinon erreur sur le type de l'image
                            $message = 'Le fichier à uploader n\'est pas une image !';
                            $message .= '<br/>L\'enregistrement de l\'image n\'a donc pas été pris en compte.';
                            $bool=false;
                        }
                    } else {
// Sinon on affiche une erreur pour l'extension
                        $message = 'L\'extension du fichier est incorrecte ! Extension attendue : .jpg, .gif, .png, .jpeg';
                        $bool=false;
                    }
                } else {
// Sinon on affiche une erreur pour le champ vide
                    $message = 'Veillez insérer une image!';
                    $bool=false;
                }
            }
        }
        //>>>>>>>>>>>>>>>>>>>>>>>> SCRIPT VERIFICATION IMAGE <<<<<<<<<<<<<<<<<<<<<<<<<<<<


        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
	<link type="text/Css" href="Css/menuBarre.Css" rel="stylesheet" />
    <link type="text/Css" href="Css/index.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/dist/Css/bootstrap.Css" rel="stylesheet" />
    <link type="text/Css" href="./bootstrap/datepicker/Css/datepicker.Css" rel="stylesheet"/>
    <link type="text/Css" href="./slider/Css/slider.Css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="./slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="./Js/rating.js"></script>

</head>
<body id="body">';

        $v = new menuBarre();
        echo $v->affichage($barre);

        echo '<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">Besoin d\'un dîner?</h1>
        <p class="shadow" style="color: #ffffff">Ce site vous propose de rechercher des dîners près de chez vous rapidement !</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#savoirPlus" style="cursor:pointer">En savoir plus</a></p>
        <!-- Modal -->
        <div class="modal fade" id="savoirPlus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Partage de diners en ligne</h4>
                    </div>
                    <div class="modal-body">
                        <p>Ce site web a été développé dans le cadre d\'un projet universitaire, au cours du M1 MIAGE à l\'Université Paris-Sud.</p>
                        <p>Il a pour but de faciliter le partage de diners entre particuliers en proposant deux fonctionnalités, très simples d\'utilisation.</p>
                        <p>Ainsi, vous pouvez proposer un dîner, organisé par vos soins, ou rechercher un dîner auquel participer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="alert alert-warning" role="alert">
       '.$res.'
		</br>
       '.$message.'
    </div>';

    }

	// Fonction permettant de supprimer un diner
    public function annulerDiner($p){

    /*    $idd = strip_tags(htmlentities($p['idd']));

        $d = new diner();
        $d = $d->getInfosDiner($idd);
        echo $idd;

        $u = new utilisateur();
        $resa = new reservation();
        $ra = new resaAnnulee();     

        $listeResa = $resa->getResaDiner($idd);
        $montantTotal = 0;
        $resAn = 0;
        $msg = "";
        $msgErreur = "";

		// Remboursement des réservations déjà existante
        foreach ($listeResa as $key => $r) {
            $montantRemb = $r->prix;
            $resAn = $ra->addResaAnnulee($r->idr, $r->idu, $r->idd, $r->jour, $montantRemb);
            if ($resAn != 0){ 
                $dr = $r->deleteResa($r->idr);
                if ($dr != 0){
                    $cs = $u->credSolde($r->idu, $montantRemb);
                    if ($cs != 0){
                        $montantTotal += $r->prix;
                    }
                    else {
                    $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
                    $msgErreur =  $msgErreur . "Le participant n°" . $r->idu ."n'a pas pu être remboursé";
                    }
                }
                else {
                    $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
                    $msgErreur =  $msgErreur . "La réservation n°" . $r->idr ."n'a pas pu être annulée";
                }
            }
            else {
                $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
                $msgErreur =  $msgErreur . "La réservation n°" . $r->idr ." n'a pas pu être ajoutée aux réservations annulées". "idu:".$r->idu.", idd:". $r->idd. ", jour:".$r->jour.", montant:".$montantRemb;
            }
        }
		
		// Suppression du diner
        if ($msgErreur == ""){ 
            $rep = $d->deleteDiner($idd);
            if ($rep != 0){ 
                $rs = $u->retirerSolde($d->idu, $montantTotal);
                if ($rs !=0){
                    $msg = "Le diner n'°".$idd. " a bien été supprimé. Les participants ont été remboursés. " .$montantTotal. "€ ont été détduits de votre solde.";
                }
                else {
                    $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
                    $msgErreur =  $msgErreur . "Le montant de " .$montantTotal. " n'a pas pu être déduit de votre solde";
                }
            }
            else {
                $msgErreur =  $msgErreur . "<span class=\"titre\">Erreur ...</span><br/>";
                $msgErreur =  $msgErreur . "Le diner n°" . $idd ."n'a pas pu être annulé";
            }
        }
        else{
            $msg = $msgErreur;
        }
        
        header('Location:./Vue/mesDiners.php?message='.$msg);*/
    }

	// Fonction permettant d'annuler une réservation
    public function annulerResa($p){
    /*    $id = 0;
		session_start();
        $id=$_SESSION['idu'];

        $r = new reservation();
        $r = $r->getInfosResa(strip_tags(htmlentities($p['idr'])));
        $montantRemb = $r->prix;
        $ra = new resaAnnulee();
        $ra->addResaAnnulee($r->idr, $id, $r->idd, $r->jour, $montantRemb);
        $r->deleteResa($r->idr);
        $u = new utilisateur();

        $u->credSolde($r->idu, $montantRemb);
        $message = 'La reservation n°'.$r->idr.' a bien été annulée.';

        header('Location:./Vue/mesResa.php?message='.$message);*/
    }

    //Fonction utilisé pour contacter l'administrateur
    //Ne produit rien si mauvais paramétrage du serveur smtp
    public function contactAdmin(){
    /*    $target="victor.breton@u-psud.fr"; //Adresse de l'administrateur

        //Test sur le champ mail
        $passage_ligne = "\n";

        $message_txt = strip_tags(htmlentities($_POST['mail'])).$passage_ligne.$passage_ligne.strip_tags(htmlentities($_POST['msg']));

        $boundary = "-----=".md5(rand());

        $sujet = strip_tags(htmlentities($_POST['objet']));

        $head="FROM: \"Site de Diner\"<victor.breton@u-psud.fr>".$passage_ligne;
        $head.="Reply-to: \"Site de Diner\"<victor.breton@u-psud.fr>".$passage_ligne;
        $head.="MIME-Version: 1.0".$passage_ligne;
        $head.="Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        $message = $passage_ligne."--".$boundary.$passage_ligne;

        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;

        $message.= $passage_ligne."--".$boundary.$passage_ligne;

        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;

        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

        mail($target,$sujet,$message,$head);

        header("Location:index.php");*/
    }

    //Fonction d'obtention des 3 derniers diners mis en ligne
    public function get3LatestDiners(){
	/*	$d = new diner();
		return $d->get3Latest();*/
    }
	
    public function insert_resa($idu,$idd,$date){
    /*    $r = new reservation();
        if(!empty($idu) && !empty($idd) && !empty($date))
            $r->insert($idu,$idd,$date);*/
    }

    public function retirerSolde($idu,$solde){
    /*    $u = new utilisateur();
        $u->retirerSolde($idu,$solde);*/
    }

    public function getSolde($id){
    /*    $u = new utilisateur();
        return $u->getId($id);*/
    }

	//Participer à un diner avec verification du solde
	public function justDoIt($idu,$idd,$date,$prix){
    /*    $f = new FuncController();
        $info=$f->getInfoClientByIdu($idu);
        if($info[0]['solde']-$prix >= 0) {
            $f->insert_resa($idu, $idd, $date);
            $f->retirerSolde($idu,$prix);
            return true;
        }
        return false;*/
    }

    public function getResaEnCours($id){
    /*    $r = new reservation();
        return $r->getAll($id);*/
    }
	
	public function getAccesById($ida){
		$a = new acces();
		return $a->getAccesById($ida);
	}
	
	public function getAccesByNom($nom){
		$a = new acces();
		$acc = $a->getAccesByNom($nom);
		if(!$acc){
			return array('ida' => '1', 0 => '1', 'nom' => 'Inscrit', 1 => 'Inscrit');
		} else {
			return $acc;
		}
	}
	
	public function getAllNiveaux() {
		$l = new niveau();
		return $l->getAllNiveaux();
	}
	
	public function getAllCriteres(){
		$c = new critere();
		return $c->getAllCriteres();
	}
	
	public function getAllTypeDeGrimpe(){
		$t = new typeGrimpe();
		return $t->getAllTypeGrimpe();
	}
	
	public function getAllCotations(){
		$cotations = array( array('idcot' => 1, 'nom' => '4a'), 
							array('idcot' => 2, 'nom' => '4b'), 
							array('idcot' => 3, 'nom' => '4c'), 
							array('idcot' => 4, 'nom' => '5a'), 
							array('idcot' => 5, 'nom' => '5b'), 
							array('idcot' => 6, 'nom' => '5c'), 
							array('idcot' => 7, 'nom' => '6a'), 
							array('idcot' => 8, 'nom' => '6b'), 
							array('idcot' => 9, 'nom' => '6c'), 
							array('idcot' => 10, 'nom' => '7a'), 
							array('idcot' => 11, 'nom' => '7b'),
							array('idcot' => 12, 'nom' => '7c'), 
							array('idcot' => 13, 'nom' => '8a'), 
							array('idcot' => 14, 'nom' => '8b'), 
							array('idcot' => 15, 'nom' => '8c'), 
							array('idcot' => 16, 'nom' => '9a'), 
							array('idcot' => 17, 'nom' => '9b'), 
							array('idcot' => 18, 'nom' => '9c'));
		return $cotations;
	}
	
	public function formulaireChangerMdp() {
		$idu = $_POST['idu'];

		//Controles	
		$u = $this->getUtilisateurId($idu);
		$bool=true;
        $res='';
		
        if (empty($_POST['mdpV'])) {
            $res.='<div class="alert alert-danger" role="alert">Pour valider les changement vous devez rentrer votre mot de passe actuel.</div>';
            $bool=false;
        } else {
            $mdpV = strip_tags(htmlentities($_POST['mdpV']));
            if(!password_verify($mdpV, $u['mdp'])){
                $res.='<div class="alert alert-danger" role="alert">Mot de passe incorrect.</div>';
                $bool=false;
            }
        }
		
		if(!empty($_POST['mdp1']) && !empty($_POST['mdp2'])){
			$mdp1 = strip_tags(htmlentities($_POST['mdp1']));
			$mdp2 = strip_tags(htmlentities($_POST['mdp2']));
			if($mdp1 == $mdp2){
				$mdp = password_hash($mdp1, PASSWORD_BCRYPT);				
			} else {
				$res.='<div class="alert alert-danger" role="alert">Les deux mots de passes ne correspondent pas. Pas de changement de mot de passe.</div>';
				$bool=false;
			}
		} else {
			$res .='<div class="alart alert-danger" role="alert">Nouveau mot de passe non renseigné.</div>';
			$bool=false;
		}
		
		//Fonction d'update
		if($bool){
			if($this->updateUtilisateur($u['idu'], $u['email'], $mdp, $u['pseudo'], $u['addresse'], $u['codePost'], $u['ville'], $u['telephone'], $u['solde'], $u['acces'], $u['niveau'], $u['diplome'], $u['dateInscription'])){
					$res.= '<div class="alert alert-success" role="alert">Modification de mot de passe effectuée avec succès !</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}

	public function formulaireChangerMdpAdmin() {
		$uti = new utilisateur();
		$u = $uti->getUtilisateurById(strip_tags(htmlentities($_POST['utilisateur'])));
		$idu = $uti['idu'];
		
		//Controles
		if(!empty($_POST['mdp']) && !empty($_POST['mdpv'])){
			$mdp1 = strip_tags(htmlentities($_POST['mdp']));
			$mdp2 = strip_tags(htmlentities($_POST['mdpv']));
			if($mdp1 == $mdp2){
				$mdp = password_hash($mdp1, PASSWORD_BCRYPT);				
			} else {
				$res.='<div class="alert alert-danger" role="alert">Les deux mots de passes ne correspondent pas.</div>';
				$bool=false;
			}
		} else {
			$res .='<div class="alart alert-danger" role="alert">Le mot de passe doit être renseigné.</div>';
			$bool=false;
		}
		
		//Fonction d'update
		if($bool){
			if($this->updateUtilisateur($u['idu'], $u['email'], $mdp, $u['pseudo'], $u['addresse'], $u['codePost'], $u['ville'], $u['telephone'], $u['solde'], $u['acces'], $u['niveau'], $u['diplome'], $u['dateInscription'])){
					$res.= '<div class="alert alert-success" role="alert">Modification de mot de passe effectuée avec succès !</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}

	public function formulaireUpdateUtilisateur(){
		$idu = $_POST['idu'];
		
		//Controles
		$u = $this->getUtilisateurId($idu);
		$bool = true;
		$res = '';
		
		if (empty($_POST['pseudo'])) {
			$pseudo = $u['pseudo'];
            //$res.='<div class="alert alert-danger" role="alert">Le pseudo doit être renseigné.</div>';
            //$bool=false;
        } else {
            $n = new utilisateur();
			$niveaux = $n->getAllUtilisateurs();
			$alreadyExist = false;
			$pseudoTMP = strip_tags(htmlentities($_POST['pseudo']));
			foreach($niveaux as $niveau){
				if($niveau['pseudo'] == $pseudoTMP){
					if($niveau['idu'] != $idu){
						$res .= '<div class="alart alert-danger" role="alert">Ce pseudo existe déjà.</div>';
						$bool = false;
						$alreadyExist = true;
						break;
					}
				}
			}
			if(!$alreadyExist){
				$pseudo = $pseudoTMP;
			}
        }

        if (empty($_POST['addresse'])) {
			$addresse = $u['addresse'];
            //$res.='<div class="alert alert-danger" role="alert">L\'addresse doit être renseigné.</div>';
            //$bool=false;
        } else {
            $addresse = strip_tags(htmlentities($_POST['addresse']));
        }

        if (empty($_POST['codePostal'])) {
			$codePost = $u['codePost'];
            //$res.='<div class="alert alert-danger" role="alert">Le codePostal doit être renseigné.</div>';
            //$bool=false;
        } else {
            $codePost = strip_tags(htmlentities($_POST['codePostal']));
        }

        if (empty($_POST['ville'])) {
			$ville = $u['ville'];
            //$res.='<div class="alert alert-danger" role="alert">La ville doit être renseignée.</div>';
            //$bool=false;
        } else {
            $ville = strip_tags(htmlentities($_POST['ville']));
        }

        if (empty($_POST['tel'])) {
            $telephone = $u['telephone'];
			//$res.='<div class="alert alert-danger" role="alert">Le téléphone doit être renseigné.</div>';
            //$bool=false;
        } else {
            $telephone = strip_tags(htmlentities($_POST['tel']));
        }
		
		if(empty($_POST['niveau'])){
			$niveau = $u['niveau'];
			//$res.='<div class="alert alert-danger" role="alert">Un niveau doit être sélectionné.</div>';
			//$bool=false;
		} else {
			$niveau = strip_tags(htmlentities($_POST['niveau']));
		}
		
		if(empty($_POST['diplome'])) {
			$diplome = $u['diplome'];
		} else {
			//A modifier pour gerer l'upload
			$diplome = strip_tags(htmlentities($_POST['diplome']));
		}
		
		//Fonction d'update
		if($bool){
			$ut = new utilisateur();
			$result = $ut->updateUtilisateur($u['idu'], $u['email'], $u['mdp'], $pseudo, $addresse, $codePost, $ville, $telephone, $u['solde'], $u['acces'], $niveau, $diplome, $u['dateInscription']);
			if($result == 1){
				$res.= '<div class="alert alert-success" role="alert">Modifications des informations effectuées avec succès !</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		
		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}

	public function formulaireCreerCritereAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$c = new critere();
			$allCrit = $c->getAllCriteres();
			$alreadyExist = false;
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			foreach($allCrit as $crit){
				if($nomTMP == $crit['nom']){
					$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$c = new critere();
			$idc = $c->insertCritere($nom);
			$res .= '<div class="alert alert-success" role="alert">Création du critère réussie. ID du nouveau critère : '.$idc.'</div>';
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireModifierCritereAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['critere'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un critère doit être sélectionné.</div>';
			$bool = false;
			$idc = 0;
		} else {
			$idc = strip_tags(htmlentities($_POST['critere']));
		}
		
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nouveau nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$n = new critere();
			$niveaux = $n->getAllCriteres();
			$alreadyExist = false;
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			foreach($niveaux as $niveau){
				if($niveau['nom'] == $nomTMP){
					if($niveau['idl'] != $idc){
						$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
						$bool = false;
						$alreadyExist = true;
						break;
					}
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$c = new critere();
			$idc = $c->updateCritere($idc, $nom);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Création du critère réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerCritereAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['critere'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un critère doit être sélectionné.</div>';
			$bool = false;
		} else {
			$idc = strip_tags(htmlentities($_POST['critere']));
		}
		
		//Fonction d'insert
		if($bool){
			$c = new critere();
			$idc = $c->deleteCritere($idc);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression du critère réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireCreerTypeDeGrimpeAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			$alreadyExist = false;
			$t = new typeGrimpe();
			$types = $t->getAllTypesGrimpe();
			foreach($types as $type){
				if($nomTMP == $type['nom']){
					$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$t = new typeGrimpe();
			$idt = $t->insertTypeGrimpe($nom);
			$res .= '<div class="alert alert-success" role="alert">Création du type de grimpe réussie. ID du nouveau type de grimpe : '.$idt.'</div>';
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireModifierTypeDeGrimpeAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['typeDeGrimpe'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un type de grimpe doit être sélectionné.</div>';
			$bool = false;
			$idt = 0;
		} else {
			$idt = strip_tags(htmlentities($_POST['typeDeGrimpe']));
		}
		
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nouveau nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$n = new typeGrimpe();
			$niveaux = $n->getAllTypesGrimpe();
			$alreadyExist = false;
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			foreach($niveaux as $niveau){
				if($niveau['nom'] == $nomTMP){
					if($niveau['idl'] != $idt){
						$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
						$bool = false;
						$alreadyExist = true;
						break;
					}
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$c = new typeGrimpe();
			$idc = $c->updateTypeGrimpe($idt, $nom);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Modification du type de grimpe réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerTypeDeGrimpeAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['typeDeGrimpe'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un type de grimpe doit être sélectionné.</div>';
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['typeDeGrimpe']));
		}
		
		//Fonction d'insert
		if($bool){
			$c = new typeGrimpe();
			$idc = $c->deleteTypeGrimpe($idt);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression du type de grimpe réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireCreerNiveauAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			$alreadyExist = false;
			$n = new niveau();
			$types = $n->getAllNiveaux();
			foreach($types as $type){
				if($nomTMP == $type['nom']){
					$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$n = new niveau();
			$idt = $n->insertNiveau($nom);
			$res .= '<div class="alert alert-success" role="alert">Création du niveau réussie. ID du nouveau niveau : '.$idt.'</div>';
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireModifierNiveauAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['niveau'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un niveau doit être sélectionné.</div>';
			$idt = 0;
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['niveau']));
		}
		
		if(empty($_POST['nom'])){
			$res .= '<div class="alart alert-danger" role="alert">Le nouveau nom doit être renseigné.</div>';
			$bool = false;
		} else {
			$n = new niveau();
			$niveaux = $n->getAllNiveaux();
			$alreadyExist = false;
			$nomTMP = strip_tags(htmlentities($_POST['nom']));
			foreach($niveaux as $niveau){
				if($niveau['nom'] == $nomTMP){
					if($niveau['idl'] != $idt){
						$res .= '<div class="alart alert-danger" role="alert">Ce nom existe déjà.</div>';
						$bool = false;
						$alreadyExist = true;
						break;
					}
				}
			}
			if(!$alreadyExist){
				$nom = $nomTMP;
			}
		}
		
		//Fonction d'insert
		if($bool){
			$c = new niveau();
			$idc = $c->updateNiveau($idt, $nom);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Modification du niveau réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerNiveauAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['niveau'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un niveau doit être sélectionné.</div>';
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['niveau']));
		}
		
		//Fonction d'insert
		if($bool){
			$c = new niveau();
			$idc = $c->deleteNiveau($idt);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression du niveau réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}

	public function formulaireCreerUtilisateurAdmin(){
		$bool = true;
		$res = '';
		$u = new utilisateur();
		$utilisateurs = $u->getAllUtilisateurs();
		
		//Controles
		if(empty($_POST['email'])){
			$res .= '<div class="alart alert-danger" role="alert">L\'email doit être renseigné.</div>';
			$bool = false;
		} else {
			$emailTMP = strip_tags(htmlentities($_POST['email']));
			$alreadyExist = false;
			foreach($utilisateurs as $utilisateur){
				if($utilisateur['email'] == $emailTMP){
					$res .= '<div class="alart alert-danger" role="alert">Cet email est déjà utilisé.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$email = $emailTMP;
			}
		}
		
		if(empty($_POST['pseudo'])){
			$res .= '<div class="alart alert-danger" role="alert">Le pseudo doit être renseigné.</div>';
			$bool = false;
		} else {
			$pseudoTMP = strip_tags(htmlentities($_POST['pseudo']));
			$alreadyExist = false;
			foreach($utilisateurs as $utilisateur){
				if($utilisateur['pseudo'] == $pseudoTMP){
					$res .= '<div class="alart alert-danger" role="alert">Ce pseudo est déjà utilisé.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$pseudo = $pseudoTMP;
			}
		}
		
		if(empty($_POST['acces'])){
			$res .= '<div class="alart alert-danger" role="alert">Le niveau d\'acces doit être renseigné.</div>';
			$bool = false;
		} else {
			$acces = strip_tags(htmlentities($_POST['acces']));
			if($acces == 0){
				$acces = 1;
			}
		}
		
		if(!empty($_POST['mdp']) && !empty($_POST['mdpv'])){
			$mdp1 = strip_tags(htmlentities($_POST['mdp']));
			$mdp2 = strip_tags(htmlentities($_POST['mdpv']));
			if($mdp1 == $mdp2){
				$mdp = password_hash($mdp1, PASSWORD_BCRYPT);				
			} else {
				$res.='<div class="alert alert-danger" role="alert">Les deux mots de passes ne correspondent pas.</div>';
				$bool=false;
			}
		} else {
			$res .='<div class="alart alert-danger" role="alert">Le mot de passe doit être renseigné.</div>';
			$bool=false;
		}
		
		if(empty($_POST['addresse'])){
			$adresse = '';
		} else {
			$adresse = strip_tags(htmlentities($_POST['addresse']));
		}
		
		if(empty($_POST['codePostal'])){
			$codePost = '';
		} else {
			$codePost = strip_tags(htmlentities($_POST['codePostal']));
		}
		
		if(empty($_POST['ville'])){
			$ville = '';
		} else {
			$ville = strip_tags(htmlentities($_POST['ville']));
		}
		
		if(empty($_POST['tel'])){
			$telephone = '';
		} else {
			$telephone = strip_tags(htmlentities($_POST['tel']));
		}
		
		if(empty($_POST['niveau'])){
			$niveau = 0;
		} else {
			$niveau = strip_tags(htmlentities($_POST['niveau']));
		}
		
		if(empty($_POST['solde'])){
			$solde = 0;
		} else {
			$solde = strip_tags(htmlentities($_POST['solde']));
		}
		
		if(empty($_POST['diplome'])){
			$diplome = '';
		} else {
			$diplome = strip_tags(htmlentities($_POST['diplome']));
		}
		
		if(empty($_POST['date'])){
			$dateInscription = time();
		} else {
			$dateInscription = strtotime(strip_tags(htmlentities($_POST['date'])));
		}
		
		//Fonction d'insert
		if($bool){
			$idu = $u->insertUtilisateur($email, $mdp, $pseudo, $adresse, $codePost, $ville, $telephone, $solde, $acces, $niveau, $diplome, $dateInscription);
			$res.= '<div class="alert alert-success" role="alert">Création du compte effectué avec succès. Id du nouvel utilisateur : '.$idu.'</div>';
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireModifierUtilisateurAdmin(){
		$bool = true;
		$res = '';
		$u = new utilisateur();
		$uti = $u->getUtilisateurById(strip_tags(htmlentities($_POST['utilisateur'])));
		$utilisateurs = $u->getAllUtilisateurs();
		
		//Controles
		if(empty($_POST['email'])){
			//$res .= '<div class="alart alert-danger" role="alert">L\'email doit être renseigné.</div>';
			//$bool = false;
			$email = $uti['email'];
		} else {
			$emailTMP = strip_tags(htmlentities($_POST['email']));
			$alreadyExist = false;
			foreach($utilisateurs as $utilisateur){
				if($utilisateur['email'] == $emailTMP){
					$res .= '<div class="alart alert-danger" role="alert">Cet email est déjà utilisé.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$email = $emailTMP;
			}
		}
		
		if(empty($_POST['pseudo'])){
			//$res .= '<div class="alart alert-danger" role="alert">Le pseudo doit être renseigné.</div>';
			//$bool = false;
			$pseudo = $uti['pseudo'];
		} else {
			$pseudoTMP = strip_tags(htmlentities($_POST['pseudo']));
			$alreadyExist = false;
			foreach($utilisateurs as $utilisateur){
				if($utilisateur['pseudo'] == $pseudoTMP){
					$res .= '<div class="alart alert-danger" role="alert">Ce pseudo est déjà utilisé.</div>';
					$bool = false;
					$alreadyExist = true;
					break;
				}
			}
			if(!$alreadyExist){
				$pseudo = $pseudoTMP;
			}
		}
		
		if(empty($_POST['acces'])){
			//$res .= '<div class="alart alert-danger" role="alert">Le niveau d\'acces doit être renseigné.</div>';
			//$bool = false;
			$acces = $uti['acces'];
		} else {
			$acces = strip_tags(htmlentities($_POST['acces']));
			if($acces == 0){
				$acces = 1;
			}
		}
		
		if(empty($_POST['addresse'])){
			//$adresse = '';
			$adresse = $uti['addresse'];
		} else {
			$adresse = strip_tags(htmlentities($_POST['addresse']));
		}
		
		if(empty($_POST['codePostal'])){
			//$codePost = '';
			$codePost = $uti['codePost'];
		} else {
			$codePost = strip_tags(htmlentities($_POST['codePostal']));
		}
		
		if(empty($_POST['ville'])){
			//$ville = '';
			$ville = $uti['ville'];
		} else {
			$ville = strip_tags(htmlentities($_POST['ville']));
		}
		
		if(empty($_POST['tel'])){
			//$telephone = '';
			$telephone = $uti['telephone'];
		} else {
			$telephone = strip_tags(htmlentities($_POST['tel']));
		}
		
		if(empty($_POST['niveau'])){
			//$niveau = 0;
			$niveau = $uti['niveau'];
		} else {
			$niveau = strip_tags(htmlentities($_POST['niveau']));
		}
		
		if(empty($_POST['solde'])){
			//$solde = 0;
			$solde = $uti['solde'];
		} else {
			$solde = strip_tags(htmlentities($_POST['solde']));
		}
		
		if(empty($_POST['diplome'])){
			//$diplome = '';
			$diplome = $uti['diplome'];
		} else {
			$diplome = strip_tags(htmlentities($_POST['diplome']));
		}
		
		if(empty($_POST['date'])){
			//$dateInscription = time();
			$dateInscription = $uti['dateInscription'];
		} else {
			$dateInscription = strtotime(strip_tags(htmlentities($_POST['date'])));
		}
		
		//Fonction d'insert
		if($bool){
			$query = $u->updateUtilisateur($uti['idu'], $email, $uti['mdp'], $pseudo, $adresse, $codePost, $ville, $telephone, $solde, $acces, $niveau, $diplome, $dateInscription);
			if($query == 1){
				$res.= '<div class="alert alert-success" role="alert">Modification de l\utilisateur réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}

	public function formulaireSupprimerUtilisateurAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['utilisateur'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un utilisateur doit être sélectionné.</div>';
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['utilisateur']));
		}
		
		//Fonction de suppression
		if($bool){
			$c = new utilisateur();
			$idc = $c->deleteUtilisateur($idt);
			if($idc == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression de l\'utilisateur réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireCreerEventAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['destination'])){
			$res .= '<div class="alart alert-danger" role="alert">Une destination doit être choisie.</div>';
			$bool = false;
		} else {
			if($_POST['destination'] == 0){
				$res .= '<div class="alart alert-danger" role="alert">Une destination doit être choisie.</div>';
				$bool = false;
			} else {
				$destination = strip_tags(htmlentities($_POST['destination']));
			}
		}
		
		if(empty($_POST['utilisateur'])){
			$res .= '<div class="alart alert-danger" role="alert">Un créateur doit être choisi.</div>';
			$bool = false;
		} else {
			if($_POST['utilisateur'] == 0){
				$createur = $_SESSION['idu'];
				//$res .= '<div class="alart alert-danger" role="alert">Un créateur doit être choisi.</div>';
				//$bool = false;
			} else {
				$createur = strip_tags(htmlentities($_POST['utilisateur']));
			}
		}
		
		if(empty($_POST['date'])){
			$res .= '<div class="alart alert-danger" role="alert">Une date doit être choisie.</div>';
			$bool = false;
		} else {
			$dateTMP = strtotime(strip_tags(htmlentities($_POST['date'])));
			if($dateTMP <= time()){
				$res .= '<div class="alart alert-danger" role="alert">La date doit être postérieure à aujourd\'hui.</div>';
				$bool = false;
			} else {
				$date = $dateTMP;
			}
		}
		
		if(empty($_POST['nbPlace'])){
			$res .= '<div class="alart alert-danger" role="alert">Un nombre de place doit être indiqué.</div>';
			$bool = false;
		} else {
			$nbPlace = strip_tags(htmlentities($_POST['nbPlace']));
		}
		
		if(empty($_POST['niveau'])){
			$niveau = '0';
		} else {
			$niveau = implode(",", $_POST['niveau']);
		}
		
		if(empty($_POST['description'])){
			$description = '';
		} else {
			$description = strip_tags(htmlentities($_POST['description']));
		}
		
		if(empty($_POST['hasLead'])){
			$hasLead = 0;
		} else {
			$hasLead = 1;
		}
		
		//Fonction d'insert
		if($bool){
			$e = new event();
			$ide = $e->insertEvent($destination, $createur, $hasLead, $nbPlace, $niveau, $description, $date);
			$res.= '<div class="alert alert-success" role="alert">Création du trip effectuée avec succès. Id du nouveau trip : '.$ide.'</div>';
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireModifierEventAdmin(){
		$bool = true;
		$res = '';
		$ev = new event();
		$e = $ev->getEventById(strip_tags(htmlentities($_POST["event"])));
		
		
		//Controles
		if(empty($_POST['destination'])){
			$destination = $e['destination'];
			//$res .= '<div class="alart alert-danger" role="alert">Une destination doit être choisie.</div>';
			//$bool = false;
		} else {
			if($_POST['destination'] == 0){
				$destination = $e['destination'];
				//$res .= '<div class="alart alert-danger" role="alert">Une destination doit être choisie.</div>';
				//$bool = false;
			} else {
				$destination = strip_tags(htmlentities($_POST['destination']));
			}
		}
		
		if(empty($_POST['utilisateur'])){
			$createur = $e['createur'];
			//$res .= '<div class="alart alert-danger" role="alert">Un créateur doit être choisi.</div>';
			//$bool = false;
		} else {
			if($_POST['utilisateur'] == 0){
				$createur = $e['createur'];
				//$res .= '<div class="alart alert-danger" role="alert">Un créateur doit être choisi.</div>';
				//$bool = false;
			} else {
				$createur = strip_tags(htmlentities($_POST['utilisateur']));
			}
		}
		
		if(empty($_POST['date'])){
			$date = $e['date'];
			//$res .= '<div class="alart alert-danger" role="alert">Une date doit être choisie.</div>';
			//$bool = false;
		} else {
			$dateTMP = strtotime(strip_tags(htmlentities($_POST['date'])));
			if($dateTMP <= time()){
				$res .= '<div class="alart alert-danger" role="alert">La date doit être postérieure à aujourd\'hui.</div>';
				$bool = false;
			} else {
				$date = $dateTMP;
			}
		}
		
		if(empty($_POST['nbPlace'])){
			$nbPlace = $e['nbPlace'];
			//$res .= '<div class="alart alert-danger" role="alert">Un nombre de place doit être indiqué.</div>';
			//$bool = false;
		} else {
			$nbPlace = strip_tags(htmlentities($_POST['nbPlace']));
		}
		
		if(empty($_POST['niveau'])){
			$niveau = $e['niveaux'];
			//$niveau = '0';
		} else {
			$niveau = implode(",", $_POST['niveau']);
		}
		
		if(empty($_POST['description'])){
			$description = $e['description'];
			//$description = '';
		} else {
			$description = strip_tags(htmlentities($_POST['description']));
		}
		
		if(empty($_POST['hasLead'])){
			$hasLead = 0;
		} else {
			$hasLead = 1;
		}
		
		//Fonction d'update
		if($bool){
			$query = $ev->updateEvent(strip_tags(htmlentities($_POST['event'])), $destination, $createur, $hasLead, $nbPlace, $niveau, $description, $date);
			if($query == 1){
				$res.= '<div class="alert alert-success" role="alert">Modification du trip réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}

		//Affichage de la page de retour
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerEventAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['event'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Un trip doit être sélectionné.</div>';
			$bool = false;
		} else {
			$idt = strip_tags(htmlentities($_POST['event']));
		}
		
		//Fonction de suppression
		if($bool){
			$e = new event();
			$query = $e->deleteEvent($idt);
			if($query == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression du trip réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireCreerInscriptionAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if(empty($_POST['utilisateur'])){
			$res .= '<div class="alart alert-danger" role="alert">Un utilisateur doit être sélectionné.</div>';
			$bool = false;
		} else {
			$utilisateurTMP = strip_tags(htmlentities($_POST['utilisateur']));
			if($utilisateurTMP == 0){
				$res .= '<div class="alart alert-danger" role="alert">Un utilisateur doit être sélectionné.</div>';
				$bool = false;
			} else {
				$utilisateur = $utilisateurTMP;
			}
		}
		
		if(empty($_POST['event'])){
			$res .= '<div class="alart alert-danger" role="alert">Un trip doit être sélectionné.</div>';
			$bool = false;
		} else {
			$eventTMP = strip_tags(htmlentities($_POST['event']));
			if($eventTMP == 0){
				$res .= '<div class="alart alert-danger" role="alert">Un trip doit être sélectionné.</div>';
				$bool = false;
			} else {
				$event = $eventTMP;
			}
		}

		if(empty($_POST['date'])){
			$date = time();
		} else {
			$date = strtotime(strip_tags(htmlentities($_POST['date'])));
		}
		
		if($bool){
			//Test de pré existance
			$ia = new inscriptionAnnulee();
			if($ia->getInscriptionAnnuleeUnique($utilisateur, $event) > 0){
				$res .= '<div class="alart alert-danger" role="alert">Cette inscription existe déjà dans la liste des archivées.</div>';
			} else {
				$i = new inscription();
				if ($i->getInscriptionUnique($utilisateur, $event) > 0){
					$res .= '<div class="alart alert-danger" role="alert">Cette inscription existe déjà.</div>';
				} else {
					//Fonction d'insert
					$idi = $i->insertInscription($utilisateur, $event, $date);
					$res .= '<div class="alert alert-success" role="alert">Création de l\'inscription réussie. ID de l\'inscription : '.$idi.'</div>';
				}
			}
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireArchiverInscriptionAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['inscription'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Une inscription doit être sélectionnée.</div>';
			$bool = false;
		} else {
			$idi = strip_tags(htmlentities($_POST['inscription']));
		}
		
		//Fonction de suppression
		if($bool){
			$i = new inscription();
	
			$query = $i->deleteInscription($idi);
			if($query == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression de l\'inscription réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}	
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireRestaurerInscriptionAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['inscription'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Une inscription doit être sélectionnée.</div>';
			$bool = false;
		} else {
			$idia = strip_tags(htmlentities($_POST['inscription']));
		}
		
		//Fonction de suppression
		if($bool){
			$ia = new inscriptionAnnulee();
	
			$query = $ia->restoreInscriptionAnnulee($idia);
			$res .= '<div class="alert alert-success" role="alert">Restauration de l\'inscription réussie.</div>';
			
		}
		echo $this->getReturnedPage($res);
	}
	
	public function formulaireSupprimerInscriptionAdmin(){
		$bool = true;
		$res = '';
		
		//Controles
		if($_POST['inscription'] == 0){
			$res .= '<div class="alart alert-danger" role="alert">Une inscription doit être sélectionnée.</div>';
			$bool = false;
		} else {
			$idia = strip_tags(htmlentities($_POST['inscription']));
		}
		
		//Fonction de suppression
		if($bool){
			$ia = new inscriptionAnnulee();
	
			$query = $ia->deleteInscriptionAnnulee($idia);
			if($query == 1){
				$res .= '<div class="alert alert-success" role="alert">Suppression de l\'inscription réussie.</div>';
			} else {
				$res .= '<div class="alert alert-danger" role="alert">Erreur lors du changement. Reessayer plus tard ou contacter un administrateur.</div>';
			}
		}
		echo $this->getReturnedPage($res);
	}

}
?>

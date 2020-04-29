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
include_once $linkIndex.'Modele/noteHote.php';
include_once $linkIndex.'Modele/noteInvite.php';
include_once $linkIndex.'Modele/diner.php';
include_once $linkIndex.'Modele/image.php';
include_once $linkIndex.'Modele/resaAnnulee.php';
include_once $linkIndex.'Modele/acces.php';
include_once $linkIndex.'Modele/critere.php';

/**
*
* Classe permettant de faire le lien entre la Vue et le Modele.
* Elle rassemble les fonctions de transition, de vérification et de test du site.
*/
class FuncController extends Controller{
    public  function __construct(){
        $this->tab=array(
			"getTheBarre" => "getTheBarre",
			"getBouttonAccueil" => "getBouttonAccueil",
			"getModalFormulaireCreationCompte" => "getModalFormulaireCreationCompte",
			"getModalFormulaireConnexion" => "getModalFormulaireConnexion",
			"getModalFormulaireRecherche" => "getModalFormulaireRecherche",
			"getModalFormulaireContacterAdmin" => "getModalFormulaireContacterAdmin",
			"getModalFormulaireCreationEvent" => "getModalFormulaireCreationEvent",
			"getModalMonCompte" => "getModalMonCompte", 
			"getModalFormulaireDeconnexion" => "getModalFormulaireDeconnexion",
			"getModalMenuAdministration" => "getModalMenuAdministration",
			"getModalFormulaireCreationCompteByAdmin" => "getModalFormulaireCreationCompteByAdmin",
			"getModalFormulaireCreationEventByAdmin" => "getModalFormulaireCreationEventByAdmin",
			"getModalFormulaireCreationCritere" => "getModalFormulaireCreationCritere",
			"getModalFormulaireSuppressionCompte" => "getModalFormulaireSuppressionCompte",
			"getModalFormulaireModifierSolde" => "getModalFormulaireModifierSolde",
			"getModalScriptForMenuBarre" => "getModalScriptForMenuBarre",
	//		"creerCompteClient" => "creerCompteClient",
	//		"creerCompteClientAdmin" => "creerCompteClientAdmin",
	//		"creerDiner" => "creerDiner",
	//		"creerDinerAdmin" => "creerDinerAdmin",
	//		"creerCritere" => "creerCritere",
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
	//		"getAllAcces" => "getAllAcces",
	//		"getAllCritere" => "getAllCritere",
	//		"getNoteMoyenneHoteByIdu" => "getNoteMoyenneHoteByIdu",
	//		"getNoteMoyenneHoteByIdd" => "getNoteMoyenneHoteByIdd",
	//		"getNoteMoyenneInviteByIdu" => "getNoteMoyenneInviteByIdu",
	//		"getNoteInviteByIdd" => "getNoteInviteByIdd",
	//		"dinerDejaNote" => "dinerDejaNote",
	//		"modifCompteAbonne" => "modifCompteAbonne",
	//		"modifCompteAdmin" => "modifCompteAdmin",
	//		"modifSolde" => "modifSolde",
	//		"modifierDiner" => "modifierDiner",
	//		"modifDinerAdmin" => "modifDinerAdmin",
	//		"annulerDiner" => "annulerDiner",
	//		"annulerResa" => "annulerResa",
	//		"contactAdmin" => "contactAdmin",
	//		"get3LatestDiners" => "get3LatestDiners",
	//		"supprimerUtilisateurAdm" => "supprimerUtilisateurAdm",
    //      "insert_resa" => "insert_resa",
    //      "justDoIt" => "justDoIt",
    //      "retirerSolde" => "retirerSolde",
    //      "getSolde" => "getSolde",
    //      "getResaEnCours" => "getResaEnCours",
    //      "getCapacite" => "getCapacite"
        );
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
									<form method="post" action="'.$lnkInd.'Site.php?a=creerCompteClient">
										<div class="modal-body">
											Veuillez renseigner vos informations
										<div class="form-group">
											<label for="message-text" class="control-label">Pseudo:</label>
											<input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" >
										</div>
										<div class="form-group">
											<label for="message-text" class="control-label">Adresse:</label>
											<textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;"></textarea>
										</div>
										<div class="form-group">
											<label for="message-text" class="control-label">Code Postal:</label>
											<input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal">
										</div>
										<div class="form-group">
											<label for="message-text" class="control-label">Ville:</label>
											<input type="text" class="form-control" id="recipient-name" name="ville">
										</div>
										<div class="form-group">
											<label for="message-text" class="control-label">N° de téléphone:</label>
											<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel">
										</div>
										<div class="form-group">
											<label for="recipient-name" class="control-label">Email:</label>
											<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="recipient-name" name="mail">
										</div>
										<div class="form-group">
											<label for="message-text" class="control-label">Mot de passe:</label>
											<input type="password" class="form-control" id="recipient-name" name="mdp">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button id="bouton" class="btn btn-info" type="submit">Créer</button>
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
		return $html;
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
		return $html;
	}
	
	public function getModalMonCompte($lnkInd, $idu) {
		$u = $this->getUtilisateurId($idu);		
		$html = '			<li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte <span class="caret"></span></a>
<!-- Menu déroulant d interface de gestion de compte -->
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" data-toggle="modal" data-target="#compteModal" style="cursor:pointer">Mes infos</a></li>
                                    <li><a href="'.$lnkInd.'Vue/mesDiners.php">Mes dîners</a></li>
                                    <li><a href="'.$lnkInd.'Vue/mesResa.php">Mes réservations</a></li>

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
                                        <form method="post" action="'.$lnkInd.'Site.php?a=modifCompteAbonne">
                                            <div class="modal-body">
                                                Modifiez vos informations ici
												<input type="hidden" name="idu" value="'.$idu.'">
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Pseudo:</label>
                                                <input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" value="'.$u['pseudo'].'" >
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Adresse:</label>
                                                <textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;">'.$u['addresse'].'</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Code Postal:</label>
                                                <input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal" value="'.$u['codePost'].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Ville:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="ville" value="'.$u['ville'].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">N° de téléphone:</label>
                                                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel" value="'.$u['telephone'].'">
                                            </div>
											<div class="form-group">
                                                <label for="message-text" class="control-label">Solde:</label>
                                                <input type="number" class="form-control" id="recipient-name" name="solde" value="'.$u['solde'].'" disabled>
                                            </div>
				<!-- Pas Encore implémenté -->
											<!--
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'invité : '.'5'.' / 5</label>
                                            </div>
											-->
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'hote : '.'5'.' / 5</label>
                                                </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Nouveau mot de passe:</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdp1">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">répéter le Nouveau mot de passe:</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdp2">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Mot de passe actuel (pour valider les changements) :</label>
                                                <input type="password" class="form-control" id="recipient-name" name="mdpV">
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
		$html = '			<li class="nav-item">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
<!-- Menu Déroulant de l interface d administration -->
								<ul class="dropdown-menu">
									<li><a data-toggle="modal" data-target="#creerCompteAdm" style="cursor:pointer">Créer un compte</a></li>
									<li><a href="'.$lnkInd.'Vue/modifCompteAdm.php">Modifier un compte utilisateur</a></li>
									<li><a data-toggle="modal" data-target="#modifSolde" style="cursor:pointer">Modifier un solde</a></li>
									<li><a data-toggle="modal" data-target="#supprimerCompteAdm" style="cursor:pointer">Supprimer un compte</a></li>
									<li><a data-toggle="modal" data-target="#creerDinerAdm" style="cursor:pointer">Créer un dîner</a></li>
									<li><a href="'.$lnkInd.'Vue/modifDinerAdm.php">Modifier un dîner</a></li>
									<li><a data-toggle="modal" data-target="#creerCritere" style="cursor:pointer">Créer un critère</a></li>
								</ul>
                            </li>';
		return $html;
	}
	
	public function getModalFormulaireCreationCompteByAdmin($lnkInd, $acces) {
		$html = '<!-- Modal -->
<!-- Formulaire de creation de compte via Admin -->
							<div class="modal fade" id="creerCompteAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'un compte client</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=creerCompteClientAdmin">
												<div class="modal-body">
													Veuillez renseigner vos informations
													<div class="form-group">
														<label for="message-text" class="control-label">Pseudo:</label>
														<input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" >
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Adresse:</label>
														<textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;"></textarea>
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Code Postal:</label>
														<input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal">
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Ville:</label>
														<input type="text" class="form-control" id="recipient-name" name="ville">
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">N° de téléphone:</label>
														<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel">
													</div>
													<div class="form-group">
														<label for="recipient-name" class="control-label">Email:</label>
														<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="recipient-name" name="mail">
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Mot de passe:</label>
														<input type="password" class="form-control" id="recipient-name" name="mdp">
													</div>
													<div class="form-group">
														<label for="message-text" class="control-label">Droits:</label>
														<select class="form-control" id="recipient-name" name="droit">'.
															$acces
														.'</select>
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
	
	public function getModalFormulaireCreationCritere($lnkInd) {
		$html = '<!-- Modal -->
<!-- Formulaire de création de critère -->
							<div class="modal fade" id="creerCritere" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'un critère</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=creerCritere">
												<div class="modal-body">
													Veuillez renseigner les informations
													<div class="form-group">
														<span class="input-group-addon">Nom</span>
														<input name="nom" type="text" class="form-control" placeholder="Nom du critère" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+">
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
	
	public function getModalFormulaireSuppressionCompte($lnkInd, $options) {
		$html = '<!-- Modal -->
<!-- Formulaire de suppression de compte -->
							<div class="modal fade" id="supprimerCompteAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Supprimer un compte</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=supprimerUtilisateurAdm">
												<div class="modal-body">
													<div class="input-group">
														<span class="input-group-addon">Compte:</span>
														<select class="form-control" name="orga">'.
															$options
														.'</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													<button id="bouton" class="btn btn-info" type="submit">Supprimer</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>';
		return $html;
	}
	
	public function getModalFormulaireModifierSolde($lnkInd, $options) {
		$html = '<!-- Modal -->
<!-- Formulaire de modification de solde -->
							<div class="modal fade" id="modifSolde" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modifier un solde</h4>
										</div>		
											<form method="post" action="'.$lnkInd.'Site.php?a=modifSolde">
												<div class="modal-body">
													<div class="input-group">
														<span class="input-group-addon">Compte:</span>
														<select class="form-control" name="idu">'.
															$options
														.'</select>
													</div>
													<div class=modal-body">
														<div class="input-group">
															<span class="input-group-addon">Modification:</span>
															<input class="form-control" type="number" name="solde" step="1" placeholder="Utiliser - pour retirer">
														</div>
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
	
	public function getModalScriptForMenuBarre() {
		$html = '
			<script>
                $("#myModal").on("shown.bs.modal", function () {
                    $("#myInput").focus()
                })
            </script>';
		return $html;
	}
	
	//Fonction utilisée lors de la création d'un compte client depuis la page principale
    public function creerCompteClient(){
/*
        // Chargement de la barre de navigation
		$barre = getTheBarre();

        // Début des vérifications de tous les paramètres.
        $u = new utilisateur();
        $utilisateur = $u->getAllEmail();
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

        if (empty($_POST['mail'])) {
            $res.='<div class="alert alert-danger" role="alert">Le mail doit être renseigné.</div>';
            $bool=false;
        } else {
            $mail = strip_tags(htmlentities($_POST['mail']));
        }
        if (empty($_POST['mdp'])) {
            $res.='<div class="alert alert-danger" role="alert">Le mot de passe doit être renseigné.</div>';
            $bool=false;
        } else {
            $mdp = strip_tags(htmlentities($_POST['mdp']));
        }

        // On vérifie que l'Email n'est pas déjà utilisé par un autre compte
        foreach($utilisateur as $t){
            if($t['email']==$_POST['mail']){
                $res.='<div class="alert alert-danger" role="alert">L\'adresse saisis exite déjà.</div>';
                $bool=false;
                break;
            }
        }

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Création effectuée avec succès !</div>';
            $u->insertClient($nom,$prenom, $addr, $cp, $ville, $tel, $mail,$mdp);
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

	//Fonction utilisée lors de la création d'un compte client par un administrateur
    public function creerCompteClientAdmin(){
/*
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
        $u = new utilisateur();
        $utilisateur = $u->getAllEmail();
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

        if (empty($_POST['mail'])) {
            $res.='<div class="alert alert-danger" role="alert">Le mail doit être renseigné.</div>';
            $bool=false;
        } else {
            $mail = strip_tags(htmlentities($_POST['mail']));
        }

        if (empty($_POST['mdp'])) {
            $res.='<div class="alert alert-danger" role="alert">Le mot de passe doit être renseigné.</div>';
            $bool=false;
        } else {
            $mdp = strip_tags(htmlentities($_POST['mdp']));
        }

        if (empty($_POST['droit'])){
            $res .='<div class=alert alert-danger" role="alert">Les droits doivent être renseignés.</div>';
            $bool=false;
        } else {
            $droit = strip_tags(htmlentities($_POST['droit']));
        }

        // On vérifie que l'Email n'est pas déjà utilisé par un autre compte
        foreach($utilisateur as $t){
            if($t['email']==$_POST['mail']){
                $res.='<div class="alert alert-danger" role="alert">L\'adresse saisis exite déjà.</div>';
                $bool=false;
                break;
            }
        }

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Création effectuée avec succès !</div>';
            $u->insertClientAdm($droit, $nom,$prenom, $addr, $cp, $ville, $tel, $mail,$mdp);
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

	//Fonction utilisée lors de la création d'un diner par le menu de navigation
    //L'organisateur de ce diner sera le compte créateur
    public function creerDiner(){
		
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
        $message='';
        if (empty($_POST['date'])){
            $res.='<div class="alert alert-danger" role="alert">La date doit être choisie.</div>';
            $bool=false;
        } 
        elseif((time()-(60*60*24)) > strtotime($_POST['date'])){ //Si la date est avant aujourd'hui
            $res.='<div class="alert alert-danger" role="alert">La date ne peut pas être antérieure à ce jour.</div>';
            $bool=false;            
        }
        else {
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

        if (empty($_POST['critere'])) {
            $res.='<div class="alert alert-danger" role="alert">Un critère doit être sélectionné.</div>';
            $bool=false;
        } else {
            $critere = strip_tags(htmlentities($_POST['critere']));
        }

        if (empty($_POST['image'])) {
            $res.='<div class="alert alert-danger" role="alert">Une image doit être insérée.</div>';
            $bool=false;
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

             if (!empty($_POST['image'])&&$bool) {
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

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Création effectuée avec succès !</div>';
            $d = new diner();
            $d->insert($id, $nom, $lieu, $desc, $prix, $date, $capa,$image,$critere);
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
    </div>
    <div class="alert alert-warning" role="alert">
       '.$res.$message.'
    </div>';

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
	
	// Fonction utilisée lors de la création d'un nouveau critère
	public function creerCritere(){
	/*	// Chargement de la barre de navigation
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
		if (empty($_POST['nom'])) {
            $res.='<div class="alert alert-danger" role="alert">Le nom doit être renseigné.</div>';
            $bool=false;
        } else {
            $nom = strip_tags(htmlentities($_POST['nom']));
        }
		
		// Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Création effectuée avec succès !</div>';
            $c = new critere();
            $c->insert($nom);
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
    </div>';*/
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
	
	// Fonction permettant de récupérer la liste des niveaux d'accès
	public function getAllAcces(){
		$a = new acces();
		return $a->getAllAcces();
	}
	
	// Fonction permettant de récupérer la liste des critères
    public function  getAllCritere(){
	/*    $c = new critere();
	    return $c->getAll();*/
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
 
	//Fonction qui permet à un abonné de modifier son compte
    public function modifCompteAbonne(){   
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
		$idu = $_POST['idu'];
		
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

        if (empty($_POST['mdpV'])) {
            $res.='<div class="alert alert-danger" role="alert">Pour valider les changement vous devez rentrer votre mot de passe actuel.</div>';
            $bool=false;
        } else {
            $mdpV = strip_tags(htmlentities($_POST['mdpV']));
            if(!$u->verifMdpClient($_SESSION['idu'], $mdpV)){
                $res.='<div class="alert alert-danger" role="alert">Mot de passe incorrect.</div>';
                $bool=false;
            }
        }

        // Si l'on a aucune erreur, on lance la fonction
        if($bool){
            $res = '<div class="alert alert-success" role="alert">Modification de compte effectuée avec succès !</div>';

			$u->updateInfosClientNoMail($_SESSION['idu'], $nom, $prenom, $addr, $cp, $ville, $tel);
            if (empty($_POST['mdp1'])) {
                $res.='<div class="alert alert-danger" role="alert">Le mot de passe est inchangé.</div>';
            } else {
				if($_POST['mdp1'] == $_POST['mdp2']){
					$mdp = strip_tags(htmlentities($_POST['mdp1']));
					$u->updateMdpClient($_SESSION['idu'], $mdp);
					$res.= '<div class="alert alert-success" role="alert">Modification de mot de passe effectuée avec succès !</div>';
				}else{
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

	// Fonction permettant à un administrateur de modifier le solde d'un compte
	public function modifSolde(){
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
        $bool=true;
        $res='';
		$idu = $_POST['idu'];
		
        if (empty($_POST['solde'])) {
            $res.='<div class="alert alert-danger" role="alert">Le solde doit être choisi.</div>';
            $bool=false;
        } else {
            $solde = strip_tags(htmlentities($_POST['solde']));
        }
		
		// Vérification de faisabilité et exécution
		$u = new utilisateur();
		$c = $u->getId($idu);
		
		foreach($c as $compte){
			$soldebd = $compte['solde'];
		}
		
		if($soldebd + $solde >= 0){
			$res = '<div class="alert alert-success" role="alert">Modifications effectuée avec succès !</div>';
			if($solde >= 0){
				$u->credSolde($idu, $solde);
			}else{
				$u->retirerSolde($idu, abs($solde));
			}
		}else{
			$res = '<span class=\"titre\">Erreur ...</span><br/>Le solde n\'a pas pu être modifié.<br/>';
		}

		// Affichage retour
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
	
	// Fonction permettant à un administrateur de supprimer un compte donné
	public function supprimerUtilisateurAdm(){
	/*		// Chargement de la barre de navigation
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
		
		$res = '<div class="alert alert-success" role="alert">Suppression effectuée avec succès !</div>';
		$u = new utilisateur();
		$u->deleteUser($_POST['orga']);
		
		
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
    </div>'
	.$res;*/
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

    public function getCapacite($idd){
    /*    $r = new reservation();
        return $r->getNbParticipants($idd);*/
    }
}
?>

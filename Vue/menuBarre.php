<?php
/**
* Fichier de Vue
*/
if (file_exists("index.php")){
    $linkIndex = './';
}
else {
    $linkIndex = '../';
}

if (file_exists($linkIndex.'Controleur/FuncController.php')){
	include_once $linkIndex.'Controleur/FuncController.php';
}
/**
* Classe permettant la mise en forme et le dynamisme de la barre de navigation principale
* Il y a 3 barres possibles en fonction de la connexion et des droits d'accès
*/
class menuBarre{

    //Récupération des string
    private $tabAction = array( "barreVisiteur" => "barreVisiteur",
        "barreAbonne" => "barreAbonne",
        "barreAdmin" => "barreAdmin");

    public function __construc(){
        
    }

    //Affichage de la barre passé en paramètre
    public function affichage($sel){
        $nom = $this->tabAction[$sel];
        return $this->$nom();
    }


	
//Barre pour les visiteurs (sans compte)
public function barreVisiteur(){
	if (file_exists("index.php")){
		$linkIndex = './';
    }else {
        $linkIndex = '../';
    }
		
	$f = new FuncController();
		
	//Chargement des critères pour les utiliser dans une select-bar
	$critere = $f->getAllCritere();
	$criteres = "";
	foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} 
		
	$res='<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->'
				.$f->getBouttonAccueil($linkIndex)				
				.'<div class="collapse navbar-collapse" id="navbarNav">'
					/*<ul class="nav navbar-nav">
						<li class="nav-item">
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
									<form method="post" action="'.$linkIndex.'Vue/recherche.php">
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
												$criteres
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
						</div>
						<li class="nav-item">
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
										<form method="post" action="'.$linkIndex.'Site.php?a=contactAdmin">
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
						</div>
					</ul>*/
					.'<ul class="nav navbar-nav navbar-right">'
						.$f->getModalFormulaireCreationCompte($linkIndex)
						.$f->getModalFormulaireConnexion($linkIndex)
					.'</ul>'
				/*</div>'*/
				.'</nav>
				<script>
				$("#myModal").on("shown.bs.modal",function () {
					$("#myInput").focus()
				})
				</script>';
	return $res;
}

public function  barreAbonne() {
    if (file_exists("index.php")){
        $linkIndex = './';
    }else{
        $linkIndex = '../';
    }
	
	$f = new FuncController();
    
	//Chargement des informations de l'utilisateur connecté
	$utilisateur = $f->getInfoClientByIdu($_SESSION['idu']);
	$idu = $_SESSION['idu'];
    foreach ($utilisateur as $uti) {
        $pseudoAbo = $uti['pseudo'];
        $mailAbo = $uti['email'];
        $telAbo = $uti['telephone'];
        $addAbo = $uti['addresse'];
        $cpAbo = $uti['codePost'];
        $villeAbo = $uti['ville'];
		$soldeAbo = $uti['solde'];
    }
	
	//Chargement des critères pour les utiliser dans une select-bar
	$critere = $f->getAllCritere();
	$criteres = "";
	foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} 
	
	//Chargement d'autres variables
    $today = date('Y-m-d');
    $moyHote = $f->getNoteMoyenneHoteByIdu($_SESSION['idu']);
    $moyInvit = $f->getNoteMoyenneInviteByIdu($_SESSION['idu']);

     $res='<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->'
					.$f->getBouttonAccueil($linkIndex)
					.'<div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
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
                                        <form method="post" action="'.$linkIndex.'Vue/recherche.php">
											<div class="modal-body">
												<p><h4>Sélectionnez les critères que vous désirez !</h4></p>
												<div class="input-group">
                                                    <span class="input-group-addon">Nom</span>
                                                    <input name="nom" type="text" class="form-control" placeholder="Nom du dîner" aria-describedby="basic-addon1">
                                                </div>
												<div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id ="date" name="date" type="text" class="form-control" data-provide="datepicker">
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
													<option value = "0" selected disabled > Critère</option >'.
													$criteres
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
                            </div>
                            <li class="nav-item">
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
                                            <form enctype="multipart/form-data" method="post" action="'.$linkIndex.'Site.php?a=creerDiner">
												<div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="'.$today.'">
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
													.$criteres
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
                            </div>
                            <li class="nav-item">
                                <a style="cursor:pointer" data-toggle="modal" data-target="#adminModal" style="cursor:pointer">Contacter un Administrateur</a>
                            </li>
                            <!-- Modal -->
<!-- Formulaire d envoie de mail à un admin -->
                            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel">Nouveau Message</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="'.$linkIndex.'Site.php?a=contactAdmin">
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
                            </div>
                        </ul>
                         <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte <span class="caret"></span></a>
<!-- Menu déroulant d interface de gestion de compte -->
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" data-toggle="modal" data-target="#compteModal" style="cursor:pointer">Mes infos</a></li>
                                    <li><a href="'.$linkIndex.'Vue/mesDiners.php">Mes dîners</a></li>
                                    <li><a href="'.$linkIndex.'Vue/mesResa.php">Mes réservations</a></li>

                                </ul>
                                
                            <!-- Modal -->
<!-- Formulaire de modification des informations du compte connecté -->
                            <div class="modal fade" id="compteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Informations et modification du compte pour : '.$mailAbo.'</h4>
                                        </div>
                                        <form method="post" action="'.$linkIndex.'Site.php?a=modifCompteAbonne">
                                            <div class="modal-body">
                                                Modifiez vos informations ici
												<input type="hidden" name="idu" value="'.$idu.'">
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Pseudo:</label>
                                                <input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" value="'.$pseudoAbo.'" >
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Adresse:</label>
                                                <textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;">'.$addAbo.'</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Code Postal:</label>
                                                <input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal" value="'.$cpAbo.'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Ville:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="ville" value="'.$villeAbo.'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">N° de téléphone:</label>
                                                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel" value="'.$telAbo.'">
                                            </div>
											<div class="form-group">
                                                <label for="message-text" class="control-label">Solde:</label>
                                                <input type="number" class="form-control" id="recipient-name" name="solde" value="'.$soldeAbo.'" disabled>
                                            </div>
				<!-- Pas Encore implémenté -->
											<!--
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'invité : '.$moyInvit.' / 5</label>
                                            </div>
											-->
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'hote : '.$moyHote.' / 5</label>
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
                            </li>
                            <li>
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
                                            <form method="post" action="'.$linkIndex.'Modele/Deconnexion.php" id="form_deconnexion">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-info" >Deconnexion</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    </nav>
                    <script>
                    $("#myModal").on("shown.bs.modal", function () {
                        $("#myInput").focus()
                    })
                    </script>';
     return $res;
}
 
public function  barreAdmin() {
	if (file_exists("index.php")){
		$linkIndex = './';
	}else{
		$linkIndex = '../';
	}
	 
	$f = new FuncController();
	
	//Chargement de la liste des utilisateur pour être utilisé dans une select-bar
	$users = $f->getAllUsers();
	$options = "";
	foreach ($users as $utilisateur){
		$options .= '<option value="'.$utilisateur['idu'].'">'.$utilisateur['idu'].' - '.$utilisateur['pseudo'].' - '.$utilisateur['email'].'</option>';
	}
	
	//Chargement de la liste des critères pour être utilisé dans une select-bar
	$critere = $f->getAllCritere();
	$criteres = "";
	foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} 
	
	//Chargement de la liste des acces pour être utilisé dans une select-bar
	$accesList = $f->getAllAcces();
	$acces = "";
	foreach ($accesList as $acc){
		$acces .= '<option value="'.$acc['ida'].'">'.$acc['nom'].'</option>';
	}
	    
	//Chargement des informations du compte connecté
    $utilisateur = $f->getInfoClientByIdu($_SESSION['idu']);
	$idu = $_SESSION['idu'];
    foreach ($utilisateur as $uti) {
        $pseudoAbo = $uti['pseudo'];
        $mailAbo = $uti['email'];
        $telAbo = $uti['telephone'];
        $addAbo = $uti['addresse'];
        $cpAbo = $uti['codePost'];
        $villeAbo = $uti['ville'];
		$soldeAbo = $uti['solde'];
    }
	
	//Chargement d'autres variables
    $today = date('Y-m-d');
    $moyHote = $f->getNoteMoyenneHoteByIdu($_SESSION['idu']);
    $moyInvit = $f->getNoteMoyenneInviteByIdu($_SESSION['idu']);	
     											
     $res='<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->'
					.$f->getBouttonAccueil($linkIndec)
					.'<div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
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
										<form method="post" action="'.$linkIndex.'Vue/recherche.php">
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
                                                    <span class="input-group-addon">Maximum d\'invités:</span>
                                                    <input name="capa" class="form-control" type="number" name="capa" min="0" max="200" step="1" placeholder="Capacité du diner">
                                                </div>
                                                 <select name = "critere" class="form-control" >
													<option value = "0" selected disabled >Critère</option >'.
													$criteres
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
                            </div>
							<li class="nav-item">
                                <a style="cursor:pointer" data-toggle="modal" data-target="#proposeModal">Proposer un Dîner</a>
                            </li>
                            <!-- Modal -->
<!-- Formulaire de création de diner par le compte connecté -->
                            <div class="modal fade" id="proposeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel">Proposer un nouveau diner</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form enctype="multipart/form-data" method="post" action="'.$linkIndex.'Site.php?a=creerDiner">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="'.$today.'">
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
													$criteres
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
                            </div>
                            <li class="nav-item">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
<!-- Menu Déroulant de l interface d administration -->
								<ul class="dropdown-menu">
									<li><a data-toggle="modal" data-target="#creerCompteAdm" style="cursor:pointer">Créer un compte</a></li>
									<li><a href="'.$linkIndex.'Vue/modifCompteAdm.php">Modifier un compte utilisateur</a></li>
									<li><a data-toggle="modal" data-target="#modifSolde" style="cursor:pointer">Modifier un solde</a></li>
									<li><a data-toggle="modal" data-target="#supprimerCompteAdm" style="cursor:pointer">Supprimer un compte</a></li>
									<li><a data-toggle="modal" data-target="#creerDinerAdm" style="cursor:pointer">Créer un dîner</a></li>
									<li><a href="'.$linkIndex.'Vue/modifDinerAdm.php">Modifier un dîner</a></li>
									<li><a data-toggle="modal" data-target="#creerCritere" style="cursor:pointer">Créer un critère</a></li>
								</ul>
                            </li>
                        </ul>
                         <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte <span class="caret"></span></a>
<!-- Menu déroulant de l interface de gestion de compte -->
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" data-toggle="modal" data-target="#compteModal" style="cursor:pointer">Mes infos</a></li>
                                    <li><a href="'.$linkIndex.'Vue/mesDiners.php">Mes dîners</a></li>
                                    <li><a href="'.$linkIndex.'Vue/mesResa.php">Mes réservations</a></li>

                                </ul>
                                
                            <!-- Modal -->
<!-- Formulaire de modification du compte connecté -->
                            <div class="modal fade" id="compteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Informations et modification du compte pour : '.$mailAbo.'</h4>
                                        </div>
                                        <form method="post" action="'.$linkIndex.'Site.php?a=modifCompteAbonne">
                                            <div class="modal-body">
                                                Modifiez vos informations ici
												<input type="hidden" name="idu" value="'.$idu.'">
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Pseudo:</label>
                                                <input type="text" pattern="[a-zA-Z0-9]+[a-zA-Z0-9 ]+" class="form-control" id="recipient-name" name="pseudo" value="'.$pseudoAbo.'" >
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Adresse:</label>
                                                <textarea class="form-control" id="recipient-name" name="addresse" style="resize: vertical;">'.$addAbo.'</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Code Postal:</label>
                                                <input type="text" pattern="[0-9]{5}" class="form-control" id="recipient-name" name="codePostal" value="'.$cpAbo.'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Ville:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="ville" value="'.$villeAbo.'">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">N° de téléphone:</label>
                                                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" id="recipient-name" name="tel" value="'.$telAbo.'">
                                            </div>
											<div class="form-group">
                                                <label for="message-text" class="control-label">Solde:</label>
                                                <input type="number" class="form-control" id="recipient-name" name="solde" value="'.$soldeAbo.'" disabled>
                                            </div>
            <!-- Pas Encore implémenté -->
											<!--
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'invité : '.$moyInvit.' / 5</label>
                                            </div>
											-->
                                            <div class="form-group">
                                                    <label for="message-text" class="control-label">Votre note moyenne d\'hote : '.$moyHote.' / 5</label>
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
                            </li>
                            <li>
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
                                            <form method="post" action="'.$linkIndex.'Modele/Deconnexion.php" id="form_deconnexion">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-info" >Deconnexion</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
					
					<!-- Modal -->
<!-- Formulaire de creation de compte via Admin -->
							<div class="modal fade" id="creerCompteAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'un compte client</h4>
										</div>		
											<form method="post" action="'.$linkIndex.'Site.php?a=creerCompteClientAdmin">
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
							</div>
							
							<!-- Modal -->
<!-- Formulaire de creation de diner via admin -->
                            <div class="modal fade" id="creerDinerAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Proposer un nouveau diner</h4>
										</div>
										<div class="modal-body">
                                            <form method="post" action="'.$linkIndex.'Site.php?a=creerDinerAdmin">
											
												<div class="input-group">
													<span class="input-group-addon">Organisateur</span>
													<select class="form-control" name="orga">'.
														$options
													.'</select>
												</div>
												<div class="input-group date">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input id="date_insert" name="date" type="text" class="form-control" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="'.$today.'">
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
													$criteres
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
                            </div>
							
							<!-- Modal -->
<!-- Formulaire de création de critère -->
							<div class="modal fade" id="creerCritere" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Création d\'un critère</h4>
										</div>		
											<form method="post" action="'.$linkIndex.'Site.php?a=creerCritere">
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
							</div>
							
							<!-- Modal -->
<!-- Formulaire de suppression de compte -->
							<div class="modal fade" id="supprimerCompteAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Supprimer un compte</h4>
										</div>		
											<form method="post" action="'.$linkIndex.'Site.php?a=supprimerUtilisateurAdm">
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
							</div>
							
							<!-- Modal -->
<!-- Formulaire de modification de solde -->
							<div class="modal fade" id="modifSolde" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modifier un solde</h4>
										</div>		
											<form method="post" action="'.$linkIndex.'Site.php?a=modifSolde">
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
							</div>
							
                    </nav>
                    <script>
                    $("#myModal").on("shown.bs.modal", function () {
                        $("#myInput").focus()
                    })
                    </script>';
     return $res;
    }
	



}
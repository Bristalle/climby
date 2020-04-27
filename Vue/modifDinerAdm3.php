<?php 
/**
* Fichier de Vue
* Permet de modifier un diner d'un utilisateur
*/
if (file_exists("index.php")){
    $linkIndex = './';
}
else {
    $linkIndex = '../';
}
include_once $linkIndex.'Controleur/FuncController.php';

// Chargement de la barre de navigation
session_start();
$barre = "barreVisiteur";
if(isset($_SESSION['acces']) && isset($_SESSION['idu']))
{
	$grade=$_SESSION['acces'];
	$id=$_SESSION['idu'];
	if ($grade == 'Administrateur'){
	}else{
		header('Location:./../index.php');
	}
	switch($grade) {
	case "Abonne":
		$barre = "barreAbonne";
		break;
	case "Administrateur":
		$barre = "barreAdmin";
		break;
	}
}else{
	if(isset($grade)){
		unset($grade);
		unset($id);
	}
	header('Location:./../index.php');
}

if($_POST['diner'] == 0){
	header('Location: modifDinerAdm.php');
}else{
	// Chargement du formulaire de modification d'un diner
	$idd = $_POST['diner'];
	$f = new FuncController();
	$diner = $f->getInfoDinerByIdd($idd);
	$users = $f->getAllUsers();
	$options = "";
	foreach ($users as $utilisateur){
		if($_POST['user'] == $utilisateur['idu']){
			$options .= '<option value="'.$utilisateur['idu'].'" selected>'.$utilisateur['idu'].' - '.$utilisateur['prenom'].' '.$utilisateur['nom'].' - '.$utilisateur['email'].'</option>';
		}else{
			$options .= '<option value="'.$utilisateur['idu'].'">'.$utilisateur['idu'].' - '.$utilisateur['prenom'].' '.$utilisateur['nom'].' - '.$utilisateur['email'].'</option>';
		}
	}
	$criteres = $f->getAllCritere();
	$crit = "";
	foreach ($criteres as $c){
		if($diner->critere == $c->idc){
			$crit .= '<option value="'.$c->idc.'" selected>'.$c->nom.'</option>';
		}else{
			$crit .= '<option value="'.$c->idc.'">'.$c->nom.'</option>';
		}
	}

	$formInfo = '<h4>Zone d\'édition</h4><input class="form-control" type="hidden" name="idd" id="idd" value="'.$idd.'"><div class="input-group"><span class="input-group-addon" for="idu">Organisateur</span><select class="form-control" id="idu" name="idu">'.$options.'</select></div><div class="input-group"><span class="input-group-addon" for="date">Date (aaaa-mm-jj):</span><input class="form-control" type="text" name="date" id="date" value="'.$diner->date.'"></div><div class="input-group"><span class="input-group-addon" for="nom">Nom:</span><input class="form-control" type="text" pattern="[A-Za-z-]*" name="nom" id="nom" value="'.$diner->nom.'"></div><div class="input-group"><span class="input-group-addon" for="lieu">Lieu:</span><input class="form-control" type="text" name="lieu" id="lieu" value="'.$diner->lieu.'"></div><div class="input-group"><span class="input-group-addon" for="desc">Description:</span><textarea name="desc" id="desc" class="form-control" style="resize: verticale;">'.$diner->desc.'</textarea></div><div class="input-group"><span class="input-group-addon" for="prix">Prix:</span><input class="form-control" type="number" name="prix" id="prix" min="0" max="1000" value="'.$diner->prix.'"></div><div class="input-group"><span class="input-group-addon" for="capa">Capacité:</span><input class="form-control" type="number" name="capa" id="capa" min="1" max="200" value="'.$diner->capacite.'"></div><div class="input-group"><span class="input-group-addon" for="idu">Critère</span><select class="form-control" id="critere" name="critere">'.$crit.'</select></div><div class="input-group"><span class="input-group-addon">Image : </span><input type="text" id="input_text" class="form-control" name="image" /><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" /><input name="fichier" type="file" id="fichier_a_uploader" class="input_file" onchange=\'document . getElementById("input_text") . value = this . value\'  /><span class="input-group-addon">Parcourir</span></div><button id="bouton" class="btn btn-info" type="submit">Modifier</button></div>';

	// Redirection avec le formulaire
	header('Location: modifDinerAdm2.php?a='.$formInfo.'&user='.$_POST['user']);
}
?>


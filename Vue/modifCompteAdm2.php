<?php 
/**
* Fichier de Vue
* Permet de modifier le compte d'un utilisateur
*/
if (file_exists("index.php")){
    $linkIndex = './';
}
else {
    $linkIndex = '../';
}

include_once './../Controleur/FuncController.php';

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

$f = new FuncController();
$id = $_POST['user'];

// Chargement du formulaire d'édition d'un utilisateur
$info = $f->getInfoClientByIdu($id);
$accesList = $f->getAllAcces();
$acces = "";
foreach ($accesList as $acc){
	if($info['0']['ida'] == $acc['ida']){
		$acces .= '<option value="'.$acc['ida'].'" selected>'.$acc['nom'].'</option>';
	}else{
		$acces .= '<option value="'.$acc['ida'].'">'.$acc['nom'].'</option>';
	}
}
$formInfo = 'Modifiez les informations :<input type="hidden" name="idu" value="'.$id.'"><div class="input-group"><span class="input-group-addon" id=mail for="email">Email:</span><input class="form-control" type="text" name="email" value="'.$info['0']['email'].'" disabled></div><div class="input-group"><span class="input-group-addon" for="nom">Nom:</span><input class="form-control" type="text" pattern="[A-Za-z-]*" name="nom" id="nom" value="'.$info['0']['nom'].'"></div><div class="input-group"></div><div class="input-group"><span class="input-group-addon" for="prenom">Prénom:</span><input class="form-control" type="text" pattern="[A-Za-z-]*" id="prenom" name="prenom" value="'.$info['0']['prenom'].'"></div><div class="input-group"><span class="input-group-addon" class="form-control" for="addresse">Adresse:</span><textarea class="form-control" id="addresse" name="addresse" style="resize: vertical;">'.$info['0']['addresse'].'</textarea></div><div class="input-group"><span class="input-group-addon" for="codePostal">Code Postal:</span><input class="form-control" type="text" pattern="[0-9]{5}" id="codePostal" name="codePostal" value="'.$info['0']['codePost'].'"></div><div class="input-group"><span class="input-group-addon" for="ville">Ville:</span><input class="form-control" type="text" id="ville" name="ville" value="'.$info['0']['ville'].'"></div><div class="input-group"><span class="input-group-addon" for="tel">N° de téléphone:</span><input class="form-control" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel" name="tel" value="'.$info['0']['telephone'].'"></div><div class="input-group"><span class="input-group-addon" for="acces">Niveau d\'acces:</span><select class="form-control" name="acces">'.$acces.'</select></div><div class="input-group"><span class="input-group-addon" for="mdp1">Nouveau mot de passe:</span><input class="form-control" type="password" id="mdp1" name="mdp1"></div><div class="input-group"><span class="input-group-addon" for="mdp2">Répéter le Nouveau mot de passe:</span><input class="form-control" type="password" id="mdp2" name="mdp2"></div><button class="btn btn-info" id="bouton" type="submit">Modifier</button></div>';

// Redirection avec le formulaire à afficher
header('Location: modifCompteAdm.php?a='.$formInfo);
?>
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
	/*foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} */
		
	$res='<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->'
				.$f->getBouttonAccueil($linkIndex)				
				.'<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="nav navbar-nav">'
						.$f->getModalFormulaireRecherche($linkIndex, $criteres)
						.$f->getModalFormulaireContacterAdmin($linkIndex)
					.'</ul>
					<ul class="nav navbar-nav navbar-right">'
						.$f->getModalFormulaireCreationCompte($linkIndex)
						.$f->getModalFormulaireConnexion($linkIndex)
					.'</ul>
				</div>'
			.'</div>
		</nav>'
		.$f->getModalScriptForMenuBarre();
	return $res;
}

public function  barreAbonne() {
    if (file_exists("index.php")){
        $linkIndex = './';
    }else{
        $linkIndex = '../';
    }
	
	$f = new FuncController();
	
	//Chargement des critères pour les utiliser dans une select-bar
	$critere = $f->getAllCritere();
	$criteres = "";
	/*foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} */
	
	//Chargement d'autres variables
    $moyHote = $f->getNoteMoyenneHoteByIdu($_SESSION['idu']);
    $moyInvit = $f->getNoteMoyenneInviteByIdu($_SESSION['idu']);

     $res='<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->'
					.$f->getBouttonAccueil($linkIndex)
					.'<div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav">'
							.$f->getModalFormulaireRecherche($linkIndex, $criteres)
                            .$f->getModalFormulaireCreationEvent($linkIndex, $criteres)
							.$f->getModalFormulaireContacterAdmin($linkIndex)
                        .'</ul>
                         <ul class="nav navbar-nav navbar-right">'
                            .$f->getModalMonCompte($linkIndex, $_SESSION['idu'])
                            .$f->getModalFormulaireDeconnexion($linkIndex)
                        .'</ul>
                    </div>
				</div>
			</nav>'
			.$f->getModalScriptForMenuBarre();
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
	$users = $f->getAllUtilisateurs();
	$options = "";
	foreach ($users as $utilisateur){
		$options .= '<option value="'.$utilisateur['idu'].'">'.$utilisateur['idu'].' - '.$utilisateur['pseudo'].' - '.$utilisateur['email'].'</option>';
	}
	
	//Chargement de la liste des critères pour être utilisé dans une select-bar
	$critere = $f->getAllCritere();
	$criteres = "";
	/*foreach($critere as $t) {
		$criteres .='<option value="'.$t->idc.'">'.$t->nom.'</option>';
	} */
	
	//Chargement de la liste des acces pour être utilisé dans une select-bar
	$accesList = $f->getAllAcces();
	$acces = "";
	/*foreach ($accesList as $acc){
		$acces .= '<option value="'.$acc['ida'].'">'.$acc['nom'].'</option>';
	}*/
	
	//Chargement d'autres variables
    $moyHote = $f->getNoteMoyenneHoteByIdu($_SESSION['idu']);
    $moyInvit = $f->getNoteMoyenneInviteByIdu($_SESSION['idu']);	
     											
    $res='	<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->'
					.$f->getBouttonAccueil($linkIndex)
					.'<div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav">'
							.$f->getModalFormulaireRecherche($linkIndex, $criteres)
                            .$f->getModalFormulaireCreationEvent($linkIndex, $criteres)
							.$f->getModalMenuAdministration($linkIndex)
                        .'</ul>
                         <ul class="nav navbar-nav navbar-right">'
                            .$f->getModalMonCompte($linkIndex, $_SESSION['idu'])
                            .$f->getModalFormulaireDeconnexion($linkIndex)
                        .'</ul>
                    </div>'
					.$f->getModalFormulaireCreationCompteByAdmin($linkIndex, $acces)
					.$f->getModalFormulaireCreationEventByAdmin ($linkIndex, $criteres, $options)
					.$f->getModalFormulaireCreationCritere($linkIndex)
					.$f->getModalFormulaireSuppressionCompte($linkIndex, $options)
					.$f->getModalFormulaireModifierSolde($linkIndex, $options)
				.'</div>
			</nav>'
			.$f->getModalScriptForMenuBarre();
    return $res;
    }
}
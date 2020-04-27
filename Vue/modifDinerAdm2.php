<?php
/**
* Fichier de Vue
* Permet de choisir un diner d'un utilisateur
*/
if(file_exists('menuBarre.php')){
	include_once 'menuBarre.php';
}

if(file_exists('Controleur/FuncController.php')){
	include_once 'Controleur/FuncController.php';
}

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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSS -->
    <link type="text/css" href="../Css/menuBarre.css" rel="stylesheet" />
    <link type="text/css" href="../Css/index.css" rel="stylesheet" />
    <link type="text/css" href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link type="text/css" href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet"/>
    <link type="text/css" href="../slider/css/slider.css" rel="stylesheet"/>



    <!--JS-->
    <script language="javascript" type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
    <script language="javascript" type="text/javascript" src="../bootstrap/dist/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="../Js/index.js"></script>
    <script language="javascript" type="text/javascript" src="../Js/menuBarre.js"></script>
    <script language="javascript" type="text/javascript" src="../slider/js/bootstrap-slider.js"></script>
    <script language="javascript" type="text/javascript" src="../Js/rating.js"></script>

</head>

<body id="body">

<?php
$v = new menuBarre();
echo $v->affichage($barre);

// Affichage d'un potentiel message
$message = '';
if (isset($_GET['message'])){
    $message = $_GET['message'];
    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
}

// Chargement du formulaire de choix du diner
$f = new FuncController();
if(isset($_POST['user'])){
	$diners = $f->getAllDinerAvenirByIdu($_POST['user']);
	$user = $_POST['user'];
}else{
	$diners = $f->getAllDinerAvenirByIdu($_GET['user']);
	$user = $_GET['user'];
}
$options = "";
foreach ($diners as $diner){
	$options .= '<option value="'.$diner->idd.'">'.$diner->idd.' - '.$diner->nom.' '.$diner->date.' - '.$diner->lieu.'</option>';
}
$formDiner = '
	<form method="post" action="modifDinerAdm3.php">
	<input type="hidden" name="user" id="user" value="'.$user.'">
	<select id="diner" name="diner" class="form-control">
	<option value="0" style="display:none;">'.
		$options
	.'</select>
	<button class="btn btn-info" type="submit">Charger</button>
	</form>';
?>

<div class ="container">
	<div class="bloc-2">
		<div class="page-header">
			<h2>Choix du Diner</h2>
		</div>
			<?php
			// Affichage du formulaire de choix du diner
			echo $formDiner;
			?>
	</div>
	<div class ="bloc-2">
		<div class="page-header">
			<h2>Informations du Diner</h2>
		</div>
        <div class="info">
            <form method="post" action="./../Site.php?a=modifDinerAdmin">
                <?php
				// Affichage du contenu du formulaire si recu
                if(isset($_GET['a'])){
                    echo $_GET['a'];
                }
                ?>
            </form>
        </div>
	</div>
</div>
</body>
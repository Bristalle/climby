<?php
/**
* Fichier de Vue
* Permet d'afficher la liste des réservation et l'historique des réservations d'un compte
*/
include_once 'menuBarre.php';
include_once '../Controleur/FuncController.php';

// Chargement de la barre de navigation
session_start();
$barre = "barreVisiteur";
$id = 0;
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

if (file_exists("index.php")){
            $linkIndex = './';
        }
else {
    $linkIndex = '../';
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
if (isset($_GET['message'])){
    $message = $_GET['message'];
    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
}
?>
<div class="container">
    <div class="bloc-2">


        <div class="page-header">
            <h2>Mes réservations</h2>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Prix</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                
                
        <?php
			$f = new FuncController();
            $idu = $id;
			
			// Chargement du formulaire des réservation en cours du compte
            $listeRC = $f->getResaEnCoursByIdu($idu);
            foreach ($listeRC as $key => $diner) {
				
                echo '<tr>
                        <td>'.$diner->nom.'</td>
                        <td>'.$diner->date.'</td>
                        <td>'.$diner->lieu.'</td>
                        <td>'.$diner->prix.' €</td>
                        <td><a id="detail'.$diner->idr.'" class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#plusInfos'.$diner->idr.'" style="cursor:pointer">+ d\'infos</a></td>
                        <td><a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#annuler'.$diner->idr.'" style="cursor:pointer">Modifier</a></td>
                        </tr>
                        <div class="modal fade" id="plusInfos'.$diner->idr.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel">Réservation N°'.$diner->idr.'</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nom du diner : '.$diner->nom.'</p>
                                            <p>Lieu : '.$diner->lieu.'</p>
                                            <p>Date : '.$diner->date.'</p>
                                            <p>Prix : '.$diner->prix.'</p>
                                            <p>'.$diner->capacite.' invités maximum</p>
                                            <p>Description : '.$diner->desc.'</p>
                                            <p>Nombre de participants : '.$f->getNbParticipantsByIdd($diner->idd).'</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
						
						<div class="modal fade" id="annuler'.$diner->idr.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="'.$linkIndex.'Site.php?a=annulerResa&idr='.$diner->idr.'">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Annuler la réservation N°'.$diner->idr.'</h4>
                                            </div>
                                            <div class="modal-body">                                            
                                                <div class="form-group">
                                                    <p>Nom du diner : '.$diner->nom.'</p>
                                                    <p>Lieu : '.$diner->lieu.'</p>
                                                    <p>Date : '.$diner->date.'</p>
                                                    <p>Prix : '.$diner->prix.'</p>
                                                    <p>'.$diner->capacite.' invités maximum</p>
                                                    <p>Description : '.$diner->desc.'</p>
                                                    <p>Nombre de participants : '.$f->getNbParticipantsByIdd($diner->idd).'</p>
                                                </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="submit">Annuler la réservation</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>';
            }
        ?>
                
            </tbody>
        </table>

    </div>

    <p></p>

    <div class="bloc-2">
        <div class="page-header">
            <h2>Mon historique</h2>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Prix</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                
                
        <?php
			// Chargement de l'historique des réservation du compte
            $listeHR = $f->getHistoResaByIdu($idu);
            foreach ($listeHR as $key => $diner) {
				
				if($f->dinerDejaNote($diner->idd, $idu)){
					$btnNote = '';
					$selectNote = '';
				}else{
					$btnNote= '<td><a id="note'.$diner->idr.'" class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#noter'.$diner->idr.'" style="cursor:pointer">Notez ce diner</a></td>';
					$selectNote = '
					<p>
					Caarrive 
					</p>';
				}
				
                echo '<tr>
                        <td>'.$diner->nom.'</td>
                        <td>'.$diner->date.'</td>
                        <td>'.$diner->lieu.'</td>
                        <td>'.$diner->prix.' €</td>
                        <td><a id="detail'.$diner->idr.'" class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#plusInfos'.$diner->idr.'" style="cursor:pointer">+ d\'infos</a></td>'.
						$btnNote.'						
                    </tr>

            <div class="modal fade" id="plusInfos'.$diner->idr.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Réservation N°'.$diner->idr.'</h4>
                        </div>
                        <div class="modal-body">
                            <p>Nom du diner : '.$diner->nom.'</p>
                            <p>Lieu : '.$diner->lieu.'</p>
                            <p>Date : '.$diner->date.'</p>
                            <p>Prix : '.$diner->prix.'</p>
                            <p>'.$diner->capacite.' invités maximum</p>
                            <p>Description : '.$diner->desc.'</p>';

							if ($f->getNoteMoyenneHoteByIdd($diner->idd)!=null){
								echo '
                                <p>Moyenne du diner : '.$f->getNoteMoyenneHoteByIdd($diner->idd).'</p>';
							}
							else {
								echo '<p>Vous n\'avez pas encore noté ce diner.</p>';
							}
							// Pas encore implémenté
							/*
							if ($f->getNoteInviteByIdd($idu,$diner->idd)!=null){
								echo '
                                <p>Note invité : '.$f->getNoteInviteByIdd($idu,$diner->idd).'</p>';
							}
							else {
								echo '
                                <p>Vous n\'avez pas encore reçu de note invité pour ce diner.</p>';
							}*/
							echo '
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="modal fade" id="noter'.$diner->idr.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Création d\'un critère</h4>
						</div>		
						<form method="post" action="'.$linkIndex.'Site.php?a=noterDiner">
							<div class="modal-body">
								<div class="form-group">
									<input name="diner" type="hidden" value="'.$diner->idd.'">
									<span class="input-group-addon">Note</span>
									<input name="note" class="form-control" type="number" name="note" min="0" max="5" step="0.25" placeholder="Note du dîner">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								<button id="bouton" class="btn btn-info" type="submit">Noter</button>
							</div>
						</form>
					</div>
				</div>
            </div>';
            }
        ?>
            </tbody>
        </table>
    </div>
</div>
</body>

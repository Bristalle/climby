<?php
/**
* Fichier de Vue
* Permet d'afficher les diners proposés par un compte
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
$message = '';
if (isset($_GET['message'])){
    $message = $_GET['message'];
    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
}
?>
<div class="container">
    <div class="bloc-2">
        <div class="page-header">
            <h2>Mes diners</h2>
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
			
			// Chargement du formulaire de la liste des diners prévus par le compte
            $listeDC = $f->getAllDinerAvenirByIdu($id);
            foreach ($listeDC as $key => $diner) {  
                echo '<tr>
                        <td>'.$diner->nom.'</td>
                        <td>'.$diner->date.'</td>
                        <td>'.$diner->lieu.'</td>
                        <td>'.$diner->prix.' €</td>
                        <td><a id="detail'.$diner->idd.'" class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#plusInfos'.$diner->idd.'" style="cursor:pointer">+ d\'infos</a></td>
                        <td><a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modifier'.$diner->idd.'" style="cursor:pointer">Modifier</a></td>
                        <td><a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#supprimer'.$diner->idd.'" style="cursor:pointer">Supprimer</a></td>
                    </tr>
                    <div class="modal fade" id="plusInfos'.$diner->idd.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Diner n°'.$diner->idd.'</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Nom : '.$diner->nom.'</p>
                                    <p>Date : '.$diner->date.'</p>
                                    <p>Prix : '.$diner->prix.'</p>
                                    <p>Description : '.$diner->desc.'</p>
                                    <p>'.$diner->capacite.' invités maximum</p>
                                    <p>Nombre de participants : '.$f->getNbParticipantsByIdd($diner->idd).'</p>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="modal fade" id="modifier'.$diner->idd.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="'.$linkIndex.'Site.php?a=modifierDiner&idd='.$diner->idd.'">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="exampleModalLabel">Diner n°'.$diner->idd.'</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Nom:</label>
                                            <input type="text" class="form-control" id="recipient-name" name="nom" value="'.$diner->nom.'">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Description:</label>
                                            <textarea class="form-control" id="recipient-name" name="descr">'.$diner->desc.'</textarea>
                                        </div>
                                        <div class="input-group">
                                                    <span class="input-group-addon">Maximum d\'invités:</span>
                                                    <input name="capa" class="form-control" type="number" name="capa" min="0" max="200" step="1" placeholder="Capacité du diner" value='.$diner->capacite.'>
                                                </div>
                                        <p>Lieu : '.$diner->lieu.'</p>
                                        <p>Date : '.$diner->date.'</p>
                                        <p>Prix : '.$diner->prix.'</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Modifier les informations</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="supprimer'.$diner->idd.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="'.$linkIndex.'Site.php?a=annulerDiner&idd='.$diner->idd.'">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="exampleModalLabel">Diner n°'.$diner->idd.'</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nom : '.$diner->nom.'</p>
                                        <p>Date : '.$diner->date.'</p>
                                        <p>Prix : '.$diner->prix.'</p>
                                        <p>Description : '.$diner->desc.'</p>
                                        <p>'.$diner->capacite.' invités maximum</p>
                                        <p>Nombre de participants : '.$f->getNbParticipantsByIdd($diner->idd).'</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" type="submit">Supprimer le diner</button>
                                    </div>
                                </div>
                            </form>
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
			//Chargement de l'historique des diners porposé par le compte
            $listeDC = $f->getHistoDinerByIdu($id);
            foreach ($listeDC as $key => $diner) {
                
                echo '<tr>
                        <td>'.$diner->nom.'</td>
                        <td>'.$diner->date.'</td>
                        <td>'.$diner->lieu.'</td>
                        <td>'.$diner->prix.' €</td>
                        <td><a id="detail'.$diner->idd.'" class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#plusInfos'.$diner->idd.'" style="cursor:pointer">+ d\'infos</a></td>
                    </tr>

                     <div class="modal fade" id="plusInfos'.$diner->idd.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">'.$diner->nom.'</h4>
                        </div>
                        <div class="modal-body">
                            <p>Lieu : '.$diner->lieu.'</p>
                            <p>Date : '.$diner->date.'</p>
                            <p>Prix : '.$diner->prix.'</p>
                            <p>Description : '.$diner->desc.'</p>
                            <p>Nombre de participants : '.$f->getNbParticipantsByIdd($diner->idd).'</p>';

						if ($f->getNoteMoyenneHoteByIdd($diner->idd)!=null){
							echo '
                                <p>Moyenne du diner : '.$f->getNoteMoyenneHoteByIdd($diner->idd).'</p>';
						}
						else {
							echo '
                                <p>Le diner n\'a pas encore été noté</p>';
						}
						echo '
                            </div>
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

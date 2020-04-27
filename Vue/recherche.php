<?php
/**
* Fichier de Vue
* Permet la recherche de diner selon des critères
*/

include_once 'menuBarre.php';

//Chargement de la barre de navigation
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
    <div class="bloc-2 row">
        <div class="page-header">
            <h2>Dîners trouvés </h2>
        </div>
        <div class="container">
            <?php
            $f = new FuncController();
            if (empty($_POST['critere']))
                $critere='';
            else
                $critere = $_POST['critere'];
            if (!empty($_SESSION['idu']))
                $idu=$_SESSION['idu'];
            else
                $idu='';
            $r = $f->rechercherDiner($idu,$_POST['nom'],$_POST['date'],$_POST['prix'],$_POST['capa'],$critere,$_POST['lieu']);
            foreach($r as $d) {
                $capacite=$f->getCapacite($d->idd);
                $photos = $d->photos;
                $photo1 = '';
                echo '<div class="col-md-3">
                            <div class="thumbnail">
                                <div id="div">
                                    <img src="../' . $d->photos->__get("ad") . '" alt="Image introuvable">
                                </div>
                                <div class="caption">
                                    <div class="scroll-x">' . $d->nom . '</div>
                                    <div class="scroll-y">' . $d->desc . '</div>';
                if(!empty($idu)){
                    $resa = $f->getResaEnCours($idu);
                    echo '<form method="post" action="' . $linkIndex . 'Site.php?a=participer">
                                         <input name="idu" type="hidden" class="form-control" value="'.$idu.'">
                                         <input name="idd" type="hidden" class="form-control" value="'.$d->idd.'">
                                         <input name="date" type="hidden" class="form-control" value="'.$d->date.'">
                                         <input name="prix" type="hidden" class="form-control" value="'.$d->prix.'">
                                             <div class="modal-footer" >';
                    if(empty($resa)){
                        echo '<button class="btn btn-warning" type = "submit" style="cursor:pointer">Je participe !</button >';
                    }
                    else {
                        foreach($resa as $r){
                            $bool=true;
                            if($d->idd == $r['idd']) {
                                $bool = false;
                                break;
                            }
                        }
                        if ($bool) {
                            if(!($d->capacite>$capacite)){
                                echo '<button class="btn btn-warning" disabled="disabled" type = "submit" style="cursor:pointer">Dîner Complet</button >';
                            }else{
                                echo '<button class="btn btn-warning" type = "submit" style="cursor:pointer">Je participe !</button >';
                            }
                        } else {
                            echo '<button class="btn btn-success" disabled="disabled" style="cursor:pointer">Déjà Réservé !</button >';
                        }
                    }
                    echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#voirDetails' . $d->idd . '" style="cursor:pointer">Voir Détails</button>
                                            </div ><!--footer-->
                               </form>';
                }
                else{
                    echo '<div class="modal-footer" >
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#voirDetails' . $d->idd . '" style="cursor:pointer">Voir Détails</button>
                                            </div ><!--footer-->';
                }
                echo '</div><!--caption-->
                        </div><!--thumbnail-->
                     </div><!--col-md-3-->
            <!-- Modal -->          
            <div class="modal fade" id="voirDetails' . $d->idd . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">' . $d->nom . '</h4>
                        </div>
                        <div class="modal-body">
                            <img src="../' . $d->photos->__get("ad") . '" alt="Image introuvable">
                            <p></p>
                            <p></p>
                            <p>Lieu : ' . $d->lieu . '</p>
                            <p>Date : ' . $d->date . '</p>
                            <p>Prix : ' . $d->prix . '</p>
                            <p>' . $d->capacite . ' invités maximum</p>';
                if ($f->getNoteMoyenneHoteByIdu($d->idu) != null) {
                    echo '
                                <p>Moyenne de l\'hôte : ' . $f->getNoteMoyenneHoteByIdu($d->idu) . '</p>';
                } else {
                    echo '
                                <p>Moyenne de l\'hôte : Aucune note pour le moment</p>';
                }
                echo '
                            <p>Description : ' . $d->desc . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

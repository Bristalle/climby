<?php
/**
 * Fichier d'accueil (Vue)
 * Permet de mettre en place la page d'accueil
 */

include_once 'Vue/menuBarre.php';
include_once 'Controleur/FuncController.php';

$f = new FuncController();
$barre = $f->getTheBarre();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dîner</title>
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

</head>

<body id="body">
<?php
$v = new menuBarre();
echo $v->affichage($barre);
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="shadow" style="color: #ffffff">On grimpe ?</h1>
        <p class="shadow" style="color: #ffffff">Choisissez votre groupe, choisissez votre grimpe !</p>
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
                        <p>Content à remplir ? Miaou miaou</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bloc-2 row">
        <div class="page-header">
            <h2>Les Nouveautés</h2>
        </div>
        <?php
        /*$f = new FuncController();
        $listeD = $f->get3LatestDiners();
        foreach($listeD as $d){
            $capacite=$f->getCapacite($d->idd);
            $photos = $d->photos;
            $photo1 = '';
            if (!empty($photos)){
                $photo1 = reset($photos)->ad;}
            echo '<div class="col-md-3">
                        <div class="thumbnail">
                            <div id="div">
                                <img src="'.$photo1.'" alt="Image introuvable">
                            </div>
                            <div class="caption">
                                <div class="scroll-x">'.$d->nom.'</div>
                                <div class="scroll-y">'.$d->desc.'</div>';
            if(!($d->capacite>$capacite)){
                $disabled='disabled';
            }
            else{
                $disabled='';
            }
            if(!empty($_SESSION['idu'])){
                $resa = $f->getResaEnCours($_SESSION['idu']);
                echo '<form method="post" action="' . $linkIndex . 'Site.php?a=participer">
                                         <input name="idu" type="hidden" class="form-control" value="'.$_SESSION['idu'].'">
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
                <div class="modal fade" id="voirDetails'.$d->idd.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">'.$d->nom.'</h4>
                            </div>
                            <div class="modal-body">
                                <img src="'.$photo1.'" alt="Image introuvable">
                                <p></p><p></p>
                                <p>Lieu : '.$d->lieu.'</p>
                                <p>Date : '.$d->date.'</p>
                                <p>Prix : '.$d->prix.'</p>
                                <p>'.$d->capacite.' invités maximum</p>';

            if ($f->getNoteMoyenneHoteByIdu($d->idu)!=null){
                echo '
                                    <p>Moyenne de l\'hôte : '.$f->getNoteMoyenneHoteByIdu($d->idu).'</p>';
            }
            else {
                echo '
                                    <p>Moyenne de l\'hôte : Aucune note pour le moment</p>';
            }
            echo '
                                <p>Description : '.$d->desc.'</p>
    
    
                                </div>
                            </div>
                        </div>
                    </div>';
        }*/
        ?>
    </div>
</div>
</body>
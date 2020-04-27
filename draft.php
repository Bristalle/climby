<?php

include_once('./Controleur/Controller.php');
include_once('./Controleur/FuncController.php');
include_once('./Modele/utilisateur.php');
include_once('base.php');

$f = new FuncController();
$u = new utilisateur();
//$u->insertClient('banane@gmail.com', 'gniakgniakgniak', 'banane', '7 rue banane', '78960', 'Voisins de banane', '0123456789', '500', 4,1, 'je suis une banane qui rampe', './../doc/diplome.pdf');


//var_dump($f->getUtilisateurId(1));

/*
for($id = 1; $id<=5; $id++){

    $c = Base::getConnection();
        if(isset($id)){
            $query = $c->prepare("SELECT * FROM utilisateur where idu = :idu");
            $query->bindParam (':idu',$id, PDO::PARAM_INT);
            $query->execute();
            $query = $query->fetchAll();
			var_dump($query);
        }
}
*/

header('./Modele/Deconnexion.php');

?>
<?php
/**
* Fichier de Controlle
* Fichier permettant de mettre en place le modèle MVC
* Fichier de pivot entre les Vues et Controleur/FuncController.php
*/
include_once 'Controleur/FuncController.php';
$c = new FuncController();
$c->callAction($_GET);
?>
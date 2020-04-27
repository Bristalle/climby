<?php
/**
* Fichier de Modele
* Permet de se deconnecter du site
*/

	if (file_exists("index.php")){
            $linkIndex = './';
        }
        else {
            $linkIndex = '../';
        }
	session_start();
	// Destruction des variables de sessions
	session_destroy();
	header("Location: ".$linkIndex."index.php");
	?>
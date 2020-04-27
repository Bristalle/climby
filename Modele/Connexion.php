<?php
/**
* Fichier de Modele
* Permet la connexion au site
*/

	include_once './../base.php';
	if (file_exists("index.php")){
            $linkIndex = './';
        }
        else {
            $linkIndex = '../';
        }

	// Début de vérification du formulaire
	if(!empty($_POST['email'])){
		if(preg_match("#^[a-z0-9._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#", $_POST["email"])){
			$id=strip_tags(htmlentities($_POST['email']));
		}
	}

	if(!empty($_POST['mdp'])){                                                       
		$pswd=strip_tags(htmlentities($_POST['mdp']));
	}

	// Connexion et affectation des variables de sessions.
	if(isset($id) && isset($pswd)) {

        $c = Base::getConnection();
        $query = $c->prepare("select mdp from utilisateur where email = :mail");
        $query->bindParam(':mail', $id, PDO::PARAM_STR);
        $query->execute();
		
		//Vérification du mot de passe
		if($query->rowCount() == 1) {
			$pswdBase = $query->fetch()['mdp'];
			if(password_verify($pswd, $pswdBase)){
				session_start();
				$grade = $c->prepare("select u.idu, a.nom from acces a, utilisateur u where u.email=:mail and a.ida=u.acces");
				$grade->bindParam(':mail', $id, PDO::PARAM_STR);
				$grade->execute();
				$grade = $grade->fetchAll();
				$id = $grade['0']['idu'];
				$grade = $grade['0']['nom'];
				$_SESSION['acces'] = $grade;
				$_SESSION['idu'] = $id;
			}
		}
		
        header("Location: " . $linkIndex . "index.php");
    }
?>
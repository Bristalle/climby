Pour installer le site de réservation de salle "TER" :

Installation des fichiers
1. Décompressez l'archive "climby.zip"
2. Placez le dossier climby dans votre dossier par défaut (www ou htdoc en général)

Initialisation de la base de donnée
1. Créez votre base de donnée à l'aide du script "Init.sql"
	(Si vous avez une erreur, utiliser Init2.sql)

Paramétrage du site
1. Editez le fichier "param_co.php" situé à la racine du dossier "climby"
2. Modifiez le contenu des variables par les votres
	2.1 "$base" est le nom de la base de donnée ("climby" par défaut, donné par le script)
	2.2 "$host" est l'hébergeur de la base de donnée ("localhost" par défaut)
	2.3 "$user" est l'identifiant de connexion à la base de donnée. Il doit avoir tous les droits ("root" par défaut)
	2.4 "$pass" le mot de passe associé à l'identifiant précédent ("" par défaut)
	
Utilisation du site
1. Connectez vous avec ces identifiants :
	Email : admin@admin.fr
	Mot de passe : cagrimpesec
2. Créez un nouveau compte administrateur depuis l'interface "Administration"
3. Supprimez le compte admin@admin.fr
4. utilisez votre nouveau compte administrateur
5. Créez un nouveau critère depuis l'interface "Administration" (nécéssaire pour la création d'un diner)
6. Profitez du site
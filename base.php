<?php
/**
* Fichier de paramétrage
* Permet d'établir une connexion entre la base de donnée et le site web
*/
include_once 'param_co.php';

class base {
    private static $connection;

    /* Permet d'obtenir une connection à la base
     * (Les paramètres de connections sont stockés dans le fichier paramco.php)
     * Il faut créer une connection PDO distante
     */
    public static function getConnection(){
        if (isset(self::$connection)) {
            return self::$connection;
        }else{
            self::$connection = self::connect();
            return self::$connection;
        }
    }

	// Création d'une connection PDO distante
    public static function connect(){
        global $host, $user, $pass, $base;
        try{
            $dns = "mysql:host=".$host.";dbname=".$base.";port=3309";
            $connection = new PDO($dns, $user, $pass,
                array(PDO::ERRMODE_EXCEPTION=>true, PDO::ATTR_PERSISTENT=>true));
            $connection->exec("SET CHARACTER SET utf8");
            return($connection);
        }catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
}
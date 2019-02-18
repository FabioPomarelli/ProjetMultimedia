<?php
class Model {
    CONST db = 'multimedia';          //nom de la base de données
    CONST host = 'localhost';          // nom de la machine hôte
//    CONST user = 'root';       // nom de l'utilisateur
//    CONST pwd = '1234512345'; // mot de passe (vide car pas de mdp)
  CONST user = 'userProjetPOO';       // nom de l'utilisateur
  CONST pwd = 'jv0hRwfQMz7u4IysKeUd'; // mot de passe (vide car pas de mdp)
CONST dsn = "mysql:dbname=".SELF::db.";host=".SELF::host;
  
 protected $_db;
  

  protected  function openBd() {
    try {
        $this->_db = new PDO(SELF::dsn, SELF::user, SELF::pwd);
        $this->_db->exec("SET NAMES 'UTF-8'");  
      
    } catch (PDOException $dbex) {
        $message = "Erreur de connexion : 
        <ul>
        <li>Fichier : </li>".htmlspecialchars($dbex->getFile())."
        <li>Code : </li>".htmlspecialchars($dbex->getCode())."
        <li>Ligne : </li>".htmlspecialchars($dbex->getLine())."
        <li>Trace : </li>".htmlspecialchars($dbex->getTraceAsString())."
        <li>Message : </li>".htmlspecialchars($dbex->getMessage())."</ul>";
        die($message);
    }
  }
}

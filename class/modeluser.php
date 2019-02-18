<?php
class ModelUser extends Model {

    CONST tableUser = 'users';
    CONST tableTentative = 'login_tentative';
    protected static $_instance = null;


    private function __construct() {
        $this->openBd();
      }

    //Base de données en SINGLETON
    public static function getInstance() {
    if (is_null(self::$_instance)){
    self::$_instance = new self();
    }
    return self::$_instance;
    }

    public function readData() {
        $res = $this->_db->query("SELECT * FROM ".SELF::tableUser);
        // les exceptions n'étant pas activées il faut tester la valeur de retour
        if ($res != false) {
            $rows = $res->fetchAll();
        }
        else{
            $rows = [];
        }
        return $rows;
    }


    public function addData(string $serialize) {
    //decode json vers obj
        $obj=unserialize($serialize);
        $stmt = $this->_db->prepare("INSERT INTO ".SELF::tableUser." (nom,  passwd ) VALUES (:nom,:passwd)");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':passwd', $passwd);
        // insertion d'une ligne
        $nom = $obj->getNom();
        $passwd = $obj->getPassword();
        $stmt->execute();
    }


    public function updateData(string $json) {
        $obj=json_decode($json);
        $stmt = $this->_db->prepare("UPDATE ".SELF::tableUser." SET nom = ?, passwd = ? WHERE id_users = ?");
        $stmt->execute([$obj->nom, $obj->passwd, $obj->id_users]);
    }


    public function dropData(int $id ) {
        $stmt = $this->_db->prepare("DELETE FROM ".SELF::tableUser." WHERE id_datas = ?");
        $stmt->execute([$id]);
    }

    public function dropTable() {
        $stmt = $this->_db->prepare("DELETE FROM ".SELF::tableUser);
        $stmt->execute();
    }

    public function searchDatas(string $nom)
    {
        if (!empty($nom))  {
            if ($stmt = $this->_db->prepare("SELECT id_users, nom, passwd FROM ".SELF::tableUser." WHERE nom = :nom LIMIT 1")) { 
                $stmt->bindParam(':nom', $nom1); // esegue il bind del parametro '$email'.
                $nom1 = $nom;
                $stmt->execute(); // esegue la query appena creata.
                list($id_users, $nomdb, $passwd) = $stmt->fetch( PDO::FETCH_NUM );
               // $stmt->store_result();
                //$stmt->bind_result($id_users, $nomdb, $passwd); // recupera il risultato della query e lo memorizza nelle relative variabili.
                //$stmt->fetch();
                $obj = new Utilisateur( $nomdb, $passwd, $id_users, true);
                return $obj->serialize();
        }
        return NULL;
        }
    }


    public function checkNumLogin($id_users):int
    {
        if (isset($id_users))  {
            // Recupero il timestamp
            $now = time();
            // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
            $valid_attempts = $now - (2 * 60 * 60); 

            if ($stmt = $this->_db->prepare("SELECT time FROM ".SELF::tableTentative." WHERE id_users_tentative = :id AND time > '$valid_attempts'")) { 
                $stmt->bindParam(':id', $id); // esegue il bind del parametro '$email'.
                $id = $id_users;

                // Eseguo la query creata.
                $stmt->execute();
                $rows = $stmt->fetchAll();

                // Verifico l'esistenza di più di 5 tentativi di login falliti.
                return count($rows);
            }
        }
        return 0;
    }


    public function recEvent($id_users){
            // Password incorretta.
            // Registriamo il tentativo fallito nel database.
            $stmt = $this->_db->prepare("INSERT INTO ".SELF::tableTentative." (id_users_tentative,  time ) VALUES (:id_users_tentative,:time)");
            $stmt->bindParam(':id_users_tentative', $id_users_tentative);
            $stmt->bindParam(':time', $time);
            // insertion d'une ligne
     
            $id_users_tentative = $id_users;
            $time = time();
            
            $stmt->execute();
    }

    public function getAuteur($id_users):string
    {
        try
        {
            if (isset($id_users))  {
                // Recupero il timestamp
                // $now = time();
                // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
                // $valid_attempts = $now - (2 * 60 * 60); 
    
                if ($stmt = $this->_db->prepare("SELECT nom FROM ".SELF::tableUser." WHERE id_users = :id")) { 
                    $stmt->bindParam(':id', $id); // esegue il bind del parametro '$email'.
                    $id = $id_users;
    
                    // Eseguo la query creata.
                    $stmt->execute();
                    $rows = $stmt->fetch();
                    // Verifico l'esistenza di più di 5 tentativi di login falliti.
                    return $rows['nom'] ?? '0';
                }
            }
            return '0';
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


<?php

class Session{
    private static $_instance;
    private static $_session_name = 'multimedia';


    private function construct(){

    }
    public static function getInstance() {
        if (is_null(self::$_instance)){
          self::$_instance = new self();
          self::$_instance->sec_session_start();
        }
        return self::$_instance;
      }


      public function getSession() {
           $this->sec_session_start();
            if (isset($_SESSION['time'])){
                $duree_session=$_SESSION['time']*60*20;//logout apres 20mins;
                $now=time();   
                if($duree_session>$now){
                    $_SESSION['time']=time();
                    return ['user_browser'=> $_SERVER['HTTP_USER_AGENT'],
                    'user_id'=> $_SESSION['user_id'],
                    'nom'=> $_SESSION['nom'],
                    'login_string'=> $_SESSION['login_string'],
                    'time'=> $_SESSION['time']];
                }
                else{
                    $this->destroyMe();
                }
            }
            return NULL;
      }     

    public function sec_session_start() {
        if(!isset($_SESSION)){
            $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
            $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
            ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
            $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
            session_name(SELF::$_session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
            session_start(); // Avvia la sessione php.
            session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
        }
      }
      

      public function destroyMe(){
            $this->sec_session_start();
            // Elimina tutti i valori della sessione.
            $_SESSION = array();
            // Recupera i parametri di sessione.
            $params = session_get_cookie_params();
            // Cancella i cookie attuali.
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            // Cancella la sessione.
            session_destroy();
            SELF::$_instance=NULL;
            header('Location: ./');
      }

      public function makeMe(Utilisateur $user){
            $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
            $user_id = preg_replace("/[^0-9]+/", "", $user->getid()); // ci proteggiamo da un attacco XSS
            $_SESSION['user_id'] = $user_id; 
            $nom = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user->getNom()); // ci proteggiamo da un attacco XSS
            $_SESSION['nom'] = $nom;
            $login_string= password_hash($user->getPassword().$user_browser, PASSWORD_DEFAULT );
            $_SESSION['login_string'] = $login_string; 
            $_SESSION['time'] = time();              
        }
    }




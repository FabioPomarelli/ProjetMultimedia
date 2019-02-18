<?php
//include('modelusers.php');
class Authentification{
    private static $_instance;

    private function construct(){
    }
    public static function getInstance() {
        if (is_null(self::$_instance)){
          self::$_instance = new self();
        }
        return self::$_instance;
      }

    public function addUser(Utilisateur $user):boolval{
        if(isset($user)){
            $bdd=ModelUser::getInstance();
            $obj = ($bdd->searchDatas($user->getNom()));
                        
            if (is_null($obj)){   //creer
                $bdd->addData($user->serialize());
                return true;
            }else{    
                return false;
            }
        }
        return false;
    }

    public function deleteUser(Utilisateur $user):boolval{
        if(isset($user)){
            $bdd=ModelUser::getInstance();
            $obj = ($bdd->searchDatas($user->getNom()));
                        
            if (!is_null($obj)){   //creer
                $userBd= unserialize($obj);
                $bdd->dropData($userBd->getId());
                return true;
            }else{    
                return false;
            }
        }
        return false;
    }



    //Crea la funzione 'checkbrute': 
    private function checkbrute($user_id) {
        $bdd=ModelUser::getInstance();
    
        $numLoginFail= $bdd->checkNumLogin($user_id);
        if($numLoginFail > 5) {
            return true;
        } else {
            return false;
        }
    }



    //login
    public function login($nom, $password) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
        $bdd=ModelUser::getInstance();
        
        if(!is_null($userBd = ($bdd->searchDatas($nom)))){
            $userBd=unserialize($userBd);
            if($this->checkbrute( $userBd->getId())==true){
                //tentative de mot de pass brute
                return false;
            }
            else {
                if (password_verify($password, $userBd->getPassword())) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                   // Password corretta!            
                        Session::getInstance()->makeMe($userBd);
                        return true;
                }else{
                    $bdd->recEvent($userBd->getId());
                    return false;
                }      
            }
        }
        // L'utente inserito non esiste.
        return false;
    }


    public function login_check() {
        if(!is_null($parametres=Session::getInstance()->getSession()) ) {  
            $bdd=ModelUser::getInstance();
            if(!is_null($userBd = ($bdd->searchDatas($parametres['nom'])))){
                $userBd=unserialize($userBd);

                $login_check=$userBd->getPassword().$parametres['user_browser'];
                if (password_verify($login_check, $parametres['login_string'])) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                    // Login eseguito!!!!
                    return true;
                }else{
                    //  Login non eseguito
                    return false;
                }      
            }
        return false; 
        }
    }

}
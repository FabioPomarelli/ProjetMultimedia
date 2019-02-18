<?php

class Authentification_resAction extends Action
{
    public $file = 'tmp/stored_datas.txt';
 
    public function launch(Request $request, Response $response)
    {
        $nom =$request->getParam('nom');
        $password =$request->getParam('password');
        $flag=false;
        if (Validator::checkUserName($nom) && Validator::checkPassword($password)) {
            if (Authentification::getInstance()->login($nom, $password)) {
                if (isset($_SESSION['msgUpdate']) && $_SESSION['msgUpdate'] == 'Bonjour '.$nom) {
                    $_SESSION['flag_message'] = false;
                } else {
                    $_SESSION['flag_message'] = true;
                    $_SESSION['msgUpdate'] = 'Bonjour '.$nom;
                }

                FrontController::getInstance()->forward('index');
                // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
                // $this->printOut();
                $flag=true;
            }
        }
        if (!$flag) {
            if (isset($_SESSION['msgUpdate']) && $_SESSION['msgUpdate'] == 'Saisie incorrecte') {
                $_SESSION['flag_message'] = false;
            } else {
                $_SESSION['flag_message'] = true;
                $_SESSION['msgUpdate'] = 'Saisie incorrecte';
            }
            FrontController::getInstance()->forward('index');
            // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
      // $this->printOut();}
        }
    }
}




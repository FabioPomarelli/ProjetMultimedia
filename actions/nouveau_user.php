<?php

class Nouveau_userAction extends Action
{
    public function launch(Request $request, Response $response)
    {
        
        $nom =$request->getParam('nom');
        $password =$request->getParam('password');

        if (Validator::checkUserName($nom) && Validator::checkPassword($password)) {
            $d= ModelUser::getInstance();
            $c= Session::getInstance();
            $user =new Utilisateur($nom, $password);
            $user->hashPassword();
            $d->addData($user->serialize());
            $_SESSION['msgUpdate'] = 'Nouvel utilisateur créé : '.$nom;
            $_SESSION['flag_message'] = true;
            
            FrontController::getInstance()->forward('index');
            // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
            // $this->printOut();
        } else {
            $message = "";
            if (!Validator::checkUserName($nom))
            {
                $message = $nom.' : nom d"utilisateur non valide (minimum 6 caractère, caractères spéciaux interdits) ';
            }
            if (!Validator::checkPassword($password))
            {
                $message .= '<12345/> mot de passe non valide (minimum 8 caractères, au moins 1 caractère spécial, au moins un numéro)';
            }
            $_SESSION['msgUpdate'] = $message;
            $_SESSION['flag_message'] = true;
            
            FrontController::getInstance()->forward('index');
            // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
            // $this->printOut();
        } 
    }
}
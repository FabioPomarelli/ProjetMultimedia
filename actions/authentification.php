<?php

class AuthentificationAction extends Action
{
    public function launch(Request $request, Response $response)
    {
        //$test = true;
        // $test = false;
        /*if (!$test) {
            $response->addVar('message', 'Login ou mot de passe incorrect, sair à nouveau');
        }*/
        $this->render(dirname(dirname(__FILE__)).'/views/authentification.php');
        $this->printOut();  
    }
}
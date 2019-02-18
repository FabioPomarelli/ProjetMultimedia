<?php
class FormulaireAction extends Action {
  public function launch(Request $request, Response $response) {
    if(Authentification::getInstance()->login_check() == true) {
        $mime_allowed = Multimedia::getMimeAllowed();
        $response->addVar('mime_allowed', $mime_allowed);
        
        $this->render(dirname(dirname(__FILE__)).'/views/formulaire.php');
        $this->printOut();
    } else {//not authorized
        /*$response->addVar('action','index' );
        $this->render(dirname(dirname(__FILE__)).'/views/index.php');
        $this->printOut();*/
        
        $request->resetParams();
        $front1= FrontController::getInstance()->dispatch();
    } 

    
    
    
    
    
   
   
  }
}

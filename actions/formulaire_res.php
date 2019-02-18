<?php
class Formulaire_ResAction extends Action {

  public function launch(Request $request, Response $response) {
    // if(Authentification::getInstance()->login_check() == true) {
    if(true) {

        //lettura parametri
        $new_val = $request->getParam('fic'); // $new_val = $_POST['fic']
        $new_files = $request->getParamsFiles('fic');
        $new_vals = $request->getParams();
        $mime_allowed = Multimedia::getMimeAllowed();
    




        if (Validator::checkString($new_vals['descr']))
        {
          $user_id = intval(Session::getInstance()->getSession()['user_id']);

          $row = new Multimedia($new_files, $new_vals['descr'], $user_id); 
          $risp=$row->safeFile();
          if($risp=='true'){
            $model = ModelDatas::getInstance();
            $model->addData($row->getJson());
  
            if (isset($_SESSION['msgUpdate']) && $_SESSION['msgUpdate'] == 'Insertion du fichier '.$new_files['name'].' réussie')
            {
              $_SESSION['flag_message'] = false;
            } else
            {
              $_SESSION['flag_message'] = true;
              $_SESSION['msgUpdate'] = 'Insertion du fichier '.$new_files['name'].' réussie';
            }
            $response->addVar('mime_allowed', $mime_allowed);
            $this->render(dirname(dirname(__FILE__)).'/views/formulaire.php');
            $this->printOut();
          }else{
            $response->addVar('new_vals',$new_vals);
            $response->addVar('mime_allowed', $mime_allowed);
            if (isset($_SESSION['msgUpdate']) && $_SESSION['msgUpdate'] == $risp)
            {
              $_SESSION['flag_message'] = false;
            } else
            {
              $_SESSION['flag_message'] = true;
              $_SESSION['msgUpdate'] = $risp;
            }

            $this->render(dirname(dirname(__FILE__)).'/views/formulaire.php');
            $this->printOut();
          }
          
          


        } else 
        {
          $response->addVar('new_vals',$new_vals);
          $response->addVar('mime_allowed', $mime_allowed);
          if (isset($_SESSION['msgUpdate']) && $_SESSION['msgUpdate'] == 'Saisie du champ description non valide, veuillez recommencer.')
          {
            $_SESSION['flag_message'] = false;
          } else
          {
            $_SESSION['flag_message'] = true;
            $_SESSION['msgUpdate'] = 'Saisie du champ description non valide, veuillez recommencer.';
          }

          $this->render(dirname(dirname(__FILE__)).'/views/formulaire.php');
          $this->printOut();
        }
      }
      else {   //not authorized

        FrontController::getInstance()->forward('index');
        // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
        // $this->printOut();
      }
  }
}

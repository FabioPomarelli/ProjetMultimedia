<?php
class LogoutAction extends Action {
  
  public function launch(Request $request, Response $response) {
   
    Session::getInstance()->destroyMe();

    FrontController::getInstance()->forward('index');
    // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
    // $this->printOut();
  }
}

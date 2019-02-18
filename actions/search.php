<?php
class SearchAction extends Action {
  public function launch(Request $request, Response $response) {
    $this->render(dirname(dirname(__FILE__)).'/views/search.php');
    $this->printOut();
   
  }
}

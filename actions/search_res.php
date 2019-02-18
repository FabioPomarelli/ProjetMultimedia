<?php
class Search_ResAction extends Action {
 
  public function launch(Request $request, Response $response) {
    
    //lettura parametri
    $new_vals = $request->getParams();

    // $row = new Multimedia($new_files, $new_vals['descr'], '1');   ///TO DO AUTEUR!!!!!
    $model = ModelDatas::getInstance();
    if (isset($new_vals['recherche']) && isset($new_vals['select_mime']))
    {
      
     /* if (!Validator::checkString($new_vals['recherche']) && $new_vals['recherche']!='')
      {
        $_SESSION['flag_message'] = true;
        $_SESSION['msgUpdate'] = 'Aucun résultat, lancer une autre recherche.';
        
        FrontController::getInstance()->forward('index');
      } */
     
      $json = $model->searchDatas($new_vals['recherche'],$new_vals['select_mime']);
    }
    

    $carouselHtml = [];

    if (isset($json) && count($json) > 0)
    {
      for ($i = 0 ; $i < count($json) ; $i++)
      {
        $carouselHtml[] = sprintf('<div class="carousel-item %s" ',$i == 0 ? "active" : "").$json[$i]->toHTMLforSearch();
      }
      $response->addVar('carouselHtml', $carouselHtml);
      $this->render(dirname(dirname(__FILE__)).'/views/search_res.php');
      $this->printOut();
    } else 
    {
      $_SESSION['flag_message'] = true;
      $_SESSION['msgUpdate'] = 'Aucun résultat, lancer une autre recherche.';
      
      FrontController::getInstance()->forward('index');
      // $this->render(dirname(dirname(__FILE__)).'/views/index.php');
      // $this->printOut();
    }
  }
}
<?php
class indexAction extends Action {
  public function launch(Request $request, Response $response) {
    $response->addVar('params', $this->_controller->getParams());



    $model = ModelDatas::getInstance();
    $json = $model->readData();
    // $model->addData($row->getJson());
    // var_dump($json);
    $htmlgallery = [];
    for ($i = 0 ; $i < count($json) ; $i++)
    {
      $htmlgallery []= $json[$i]->toHTML();
    }

    $response->addVar('gallery', $htmlgallery);
    $this->render(dirname(dirname(__FILE__)).'/views/index.php');
    $this->printOut();
  }
}
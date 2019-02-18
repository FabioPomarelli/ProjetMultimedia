<?php
class FrontController {
  protected $_defaults = ['action' => 'index'];
  protected $_request;
  protected $_response;
  protected static $_instance = null;
 
  private function __construct() {
    $this->_request = new Request();  
    $this->_response = new Response();
    $this->_view = new View();
  }
 
  public static function getInstance() {
    if (is_null(self::$_instance)){
      self::$_instance = new self();
    }
    return self::$_instance;
  }
 
  public function getUrl($action, $params = []) {
    return $this->_view->getUrl($action, $params);
  }
 
  public function dispatch($defaults = null) {
    $route = $this->_request->route();
    $parsed = $this->_request->getParams();
    $parsed = array_merge($this->_defaults, $parsed);
    $this->forward($route);
  }
 
  public function forward($action) {
    $command = $this->_getCommand($action);
    $command->launch($this->_request, $this->_response);
  }
 
  // par convention le _ en préfixe indique un méthode privée
  private function _getCommand($action) {
    if(!file_exists($path = "actions/$action.php")) {
      throw new Exception("Commande inconnue actions/$action.php");
    }
    require($path);

    $class = ucfirst($action).'Action';
    return new $class($this);
  }
 
  public function getParams() {
    return $this->_request->getParams();
  }
 
  public function getResponse() {
    return $this->_response;
  }
 
  public function redirect($url) {
    $this->_response->redirect($url);
  }
 
  public function render($file) {
    $this->_response->setBody($this->_view->render($file,$this->_response->getVars()));
  }
}
<?php
class Response {
  private $_vars = [];
  // je veux une interprétation 100% XML !Content-Type: text/html; charset=utf-8
  //private $_headers = ['Content-type' => 'application/xhtml+xml'];
  private $_headers = ['Content-type' => 'text/html'];
  private $_body;
 
  public function addVar($key, $value) {
    $this->_vars[$key] = $value;
  }
 
  public function getVar($key) {
    return $this->_vars[$key];
  }
 
  public function getVars() {
    return $this->_vars;
  }
 
  public function setBody($value) {
    $this->_body = $value;
  }
 
  public function killVar($nom_var)
  {
    unset($_var[$nom_var]);
  }

  public function redirect($url, $permanent = false) {
    if ($permanent){
      $this->_headers['Status'] = '301 Moved Permanently';
    } else {
      $this->_headers['Status'] = '302 Found';
    }
    $this->_headers['location'] = $url;
  }
 
  public function printOut() {
    foreach ($this->_headers as $key => $value) {
      header($key.': '. $value);
    }
    
    echo $this->_body;
  }
}

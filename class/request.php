<?php
class Request implements RequestInterface  {
  public function getParam(string $key): string {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$key])){
      return $_POST[$key];
    } elseif (isset($_GET[$key])) {
      return $_GET[$key];
    } else {
      return false;
    }
  }
 
  public function getParams(): array {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      return $_POST;
    } else {
      return $_GET;
    }
  }

  public function resetParams() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST=array();
    } else {
      $_GET=array();
    }
  }

  public function getParamsFiles(string $key): array {
    //is_uploaded_file($_FILES[$input_name]['tmp_name']

    if (isset($_FILES) && is_uploaded_file($_FILES[$key]['tmp_name'])){
      return $_FILES[$key];
    } else {
      return [];
    }
  }
 
  public function route(): string {
    $action = $this->getParam('action');
    if (empty($action)) $action = 'index';
    return $action;
  }
}
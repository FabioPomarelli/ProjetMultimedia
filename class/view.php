<?php
class View {
 
  public function render($file, $assigns = []) {
    array_walk_recursive($assigns, function(&$v) {$v = ($v);}); // évite l'injection XSShtmlspecialchars


    extract($assigns);
    ob_start();
    include 'header.php';
    require($file);
    include 'footer.html';
    return ob_get_clean();
  }
 
  public function getUrl($action, $params = []) {
    $res = '?action='.$action;
    foreach ($params as $key => $val) {
      $res .= '&amp;'.$key.'='.urlencode($val);
    }
    return $res;
  }
}

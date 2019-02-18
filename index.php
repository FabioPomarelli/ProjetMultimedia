<?php

// autoloader de base permettent de localiser toutes les classes
spl_autoload_register(function($class) {
    @include('class/'.strtolower($class).'.php');


});


try {
  $session =Session::getInstance();
  $front = FrontController::getInstance()->dispatch();
  
  
} catch (Exception $ex) {

  echo $ex->getMessage();
}

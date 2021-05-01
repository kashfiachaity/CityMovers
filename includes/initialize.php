<?php

  ob_start(); // turn on output buffering

  
  
  require_once('./includes/configuration.php');
  require_once('./includes/database_connection.php');
  require_once('./includes/functions.php');
  require_once('./includes/formValidations.php');
  require_once('./includes/errorFunctions.php');

// -> All classes in directory


// Autoload class definitions
function my_autoload($class) {
  if(preg_match('/\A\w+\Z/', $class)) {
    include('./class/' . $class . '.class.php');
  }
}
spl_autoload_register('my_autoload');
 

  

  $database = db_connect();
  Database::set_database($database);
  $session = new Session;

?>
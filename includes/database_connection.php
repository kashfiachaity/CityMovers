<?php require_once('configuration.php');?>
<?php

function db_connect() {
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($db_connection);
  return $db_connection;
}

function confirm_db_connect($db_connection) {
  if($db_connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $db_connection->connect_error;
    $msg .= " (" . $db_connection->connect_errno . ")";
    exit($msg);
  }

}

function db_disconnect($db_connection) {
  if(isset($db_connection)) {
    $db_connection->close();
  }
}

?>
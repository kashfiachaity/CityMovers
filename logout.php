<?php
 require_once('includes/initialize.php');


$session->logout();

redirect_to(url_for('index.php'));

?>
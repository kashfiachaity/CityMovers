<?php

function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('loginForm.php'));
  } else {
    
  }
}

function require_booking_info() {
  global $session;
  if(!$_SESSION['movingInformation']) {
    redirect_to(url_for('index.php'));
  } else {
    
  }
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    foreach($errors as $error) {
      $output .= "<p class='alert alert-danger'><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\" style=\"margin-right: 5px;\"></i>" . ($error) . "</p>";
    }
    $output .= "</div>";
  }
  return $output;
}

function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div class="alert alert-warning" id="message">' . ($msg) . '</div>';
  }
}

?>
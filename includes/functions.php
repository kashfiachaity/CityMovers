<?php 
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function url_for($script_path) {
    return $script_path;
}

function redirect_to($location) {
    header("Location: " . $location);
    exit;
}
?>
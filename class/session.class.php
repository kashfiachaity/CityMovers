<?php

class  Session {

    public $user_id;
    

    public function __construct() {
        session_start();
        $this->check_stored_login();
    }

    public function login($user) {
        if($user) {
            session_regenerate_id();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->userRole;
            $this->user_id = $user->id;
            

        }
        return true;
    }

    public function is_logged_in() {
        return isset($this->user_id);
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($this->user_id);
        

        return true;
    }

    private function check_stored_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            

        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }


}

?>
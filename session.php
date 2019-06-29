<?php 
require_once('init.php');
class Session {

    function __construct()
    {
        session_start();
    }
    public function set_variable($assoc, $variable) {
        $_SESSION[$assoc] = $variable;
        return $_SESSION[$assoc];
    }
}

$session = new Session();

?>
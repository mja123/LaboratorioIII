<?php

class Validate {

    public function checkSession() {
        session_start();
        
        if(isset($_SESSION["admin"])) {
            return array("session" => "ok");
            
        } else {
            return array("error" => "Error 403: debes ser admin para entrar");

        }   
    }
}

$validate = new Validate();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $answer = $validate->checkSession();
    echo json_encode($answer);
}
?>
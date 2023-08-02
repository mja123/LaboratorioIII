<?php

class Validate {

    public function checkSession() {
        session_start();
        
        if(isset($_SESSION["admin"])) {
            header("HTTP/1.1 200");
            return array("session" => "ok");
            
        } else {

            header("HTTP/1.1 403");
            return array("error" => "Debes ser admin para entrar");

        }   
    }
}

$validate = new Validate();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $answer = $validate->checkSession();
    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *'); 
    echo json_encode($answer);
}
?>
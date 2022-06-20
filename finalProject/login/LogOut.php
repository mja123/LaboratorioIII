<?php
class LogOut {
    public function closeSession() {
        session_start();
        session_destroy();
        header("Location:http://localhost/finalProject/homePage/view/homePage.html");
    } 
}

$logOut = new LogOut();
$logOut->closeSession();
?>
<?php
    if (($_POST['username'] == "admin") && ($_POST['password'] == "admin")) {
        echo "<p Bienvenido ", $_POST['username'], "p>"; 
    } else {
        echo "<p Credenciales inválidas p>"; 
    }
?>
<?php
    if (($_POST['userName'] == "admin") && ($_POST['password'] == "admin")) {
        echo "Bienvenido ", $_POST['userName']; 
    } else {
        echo "Credenciales inválidas"; 
    }
?>
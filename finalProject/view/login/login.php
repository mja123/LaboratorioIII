<?php
    if (($_POST['userName'] == "admin") && ($_POST['password'] == "admin")) {
        header("Location: http://localhost/finalProject/homePage/homePage.html");
    } else {
        echo "Credenciales inválidas"; 
    }
?>
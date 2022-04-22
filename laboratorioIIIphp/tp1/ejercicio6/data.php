<!--
    Tomar	el	mismo	formulario	del	ejercicio	anterior,	y	enviar	todos	los	
datos	a	un	nuevo	archivo	PHP.	En	el	mismo	se	debe	realizar	las	siguientes	
validaciones:	
• Que	todos	los	campos	obligatorios	estén	completos.
• Que	el	email	sea	válido.	(no	es	necesario	validar	que	exista	el	correo)
• Que	sea	mayor	a	18	años	de	edad

-->

<?php

    $correctForm = true;

    if ($_POST['age'] <= 18) {
        echo "Tienes que ser mayor a 18 años...";
        $correctForm = false;
        echo "<br>";
    }
    if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        echo "Emial no válido.";
        $correctForm = false;
        echo "<br>";
    }  

    //Valida si no se eligió ningún hobby 
    // No valido si existen los otros campos obligatorios porque no se puede enviar el formulario si no están.
    if (!((isset($_POST['read']) || isset($_POST['videoGames']) || isset($_POST['tv'])))) {
        echo "Hobby no elegido.";
        $correctForm = false;
        echo "<br>";
    }
    
    if ($correctForm) {
        echo "Todos los datos fueron completados correctamente!";
    }
    
?>
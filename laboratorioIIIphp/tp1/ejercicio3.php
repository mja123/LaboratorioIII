<!-- 
a: Realizar	la	tabla	que	se	muestra	a	continuación,	insertando	un	
comentario	PHP	al	lado	de cada	formato de	fecha empleado con	la	
descripción	de	lo	utilizado.
Lunes	06	de	Abril	de	2020
06/04/20
Lun	6 12:02	am
Primer	Semana	del	mes	de	Abril
-->
<?php
    echo date("D d F o"); //D: week day, d: number day with zero at the beginning, F: month, o: year 
    echo "<br>";
    echo date("d/m/Y"); //d: day, m: month, Y: year
    echo "<br>";
    echo date("D j G:h a"); // D: week day, j: number day without zero, G: hours without initial zero, h: minutes with initial zero, a: ante meridiem in lowercase.
    echo "<br>";
    echo "La primera semana de abril empieza en el día: ", date("l", strtotime("first week in April"));

?>
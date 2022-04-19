<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
         <tr>
            <th>Numero 1</th>
            <th>Numero 2</th>
            <th>Resultado</th>
        </tr>
    <?php

        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $result =  $number1 * $number2;
        
        echo "<tr>";
             echo "<td> $number1 </td>";
             echo "<td> $number2 </td>";
             echo "<td> $result </td>";
        echo "</tr>";
        
    ?>
     
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php
        $table = 3;
        $count = 1;
        $result = 0;
    ?>
    <table>
        <tr>
            <th>Numero</th>
            <th>Tabla</th>
            <th>Resultado</th>
        </tr>
        <?php
            for ($i = 1; $i < 11; $i++) {

                $result = $table * $i;
                echo "<tr>";
                    echo "<td> $count </td>";
                    echo "<td> $table </td>";
                    echo "<td> $result  </td>";
                echo "</tr>";
                $count++;
            }
        ?>
        
    </table>
</body>
</html>


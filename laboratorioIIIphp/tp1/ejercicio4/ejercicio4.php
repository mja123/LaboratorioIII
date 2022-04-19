<!--: Agregar	un	formulario	HTML	al	ejercicio	de	la	tabla	de	multiplicar,	y	
que	las	tablas	se	generen	a	partir	de	los	números	enviados.	Deben	existir	3	
campos	numéricos. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <form action="multiply.php" method="post" enctype="multipart/form-data" >
        <label for="number1"> Numero 1</label>
        <input type="text" name="number1" required><br>
        <label for="number2"> Numero 2</label>
        <input type="text" name="number2" required><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

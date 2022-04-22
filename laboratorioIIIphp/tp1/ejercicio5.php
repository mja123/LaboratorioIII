<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ejercicio 5</title>
  </head>

  <body>
    <form action="#" method="POST">
      <label for="name">Nombre</label> <br />
      <input type="text" id="name" name="name" required /> <br /><br />

      <label for="lastName">Apellido</label> <br />
      <input type="text" id="lastName" name="lastName" required /> <br /><br />

      <label for="dni">DNI</label> <br />
      <input type="number" id="dni" name="dni" required /><br /><br />

      <label for="age">Edad</label> <br />
      <input type="number" id="age" name="age" required/> <br /><br />

      <label for="email">Email</label> <br />
      <input type="text" id="email" name="email" required /> <br />

      <p>Por favor, elija su sexo:</p>
      <input type="radio" id="female" name="gender" value="female" required />
      <label for="female">Femenino</label> <br />
      <input type="radio" id="male" name="gender" value="male" required />
      <label for="gender">Masculino</label> <br />
      <input type="radio" id="other" name="gender" value="other" required />
      <label for="other">Otro</label> <br /><br />

      <label for="children">Cantidad de hijos/as</label> <br />
      <input type="number" id="children" name="children" /> <br /><br />

      <label for="civilStatus">Estado civil</label> <br />
      <select name="civilStatus" id="civilStatus" required>
        <option value="single">Soltero/a</option>
        <option value="merried">Casado/a</option>
      </select>

      <section>
        <p>Dirección</p>

        <label for="street">Calle</label>
        <input type="text" id="street" name="street" required />

        <label for="number">Número</label>
        <input type="number" id="number" name="number" required />

        <label for="tower">Torre</label>
        <input type="text" id="tower" name="tower" />

        <label for="flat">Piso</label>
        <input type="text" id="flat" name="flat" /> <br />

        <label for="deparmetn">Departamento</label>
        <input type="text" id="deparment" name="deparment" />

        <label for="location">Localidad</label>
        <input type="text" id="location" name="location" required />
        <label for="state">Provincia</label>
        <input type="text" id="state" name="state" required />

        <label for="country">País</label>
        <input type="text" id="country" name="country" required /> <br />
      </section>

      <section >
        <p>Hobbies:</p>
        <input type="checkbox" id="read" name="read" value="read" />
        <label for="read">Leer</label> <br />
        <input type="checkbox" id="videoGames" name="videoGames" value="videoGames" />
        <label for="videoGames">Videojuegos</label> <br />
        <input type="checkbox" id="tv" name="tv" value="tv"  />
        <label for="tv">Mirar TV</label> <br />
        <br />
      </section>

      <input type="submit" value="Enviar" />
    </form>

    <?php
        foreach($_POST as $key=>$value) {
          echo "$key: $value";
          echo "<br>";
        }
        
    ?>
  </body>
</html>

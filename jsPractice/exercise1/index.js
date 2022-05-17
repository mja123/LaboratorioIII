//Exercise 1

let student = {
  name: "Matías",
  curse: "Informatics and Software Development degree",
  dni: 4222222,
  email: "email@gmail.com",
};

const fromObjectToArray = (object) => {
  studentArray = Object.keys(object);
  console.log(studentArray);
  return studentArray;
};

//Exercise 2

function changeBodyBackgroundColor() {
  let color = document.getElementById("changeColor").value;

  if (color == "#0f0" || color == "#00ff00" || color == "green") {
    console.log(false);
  } else {
    const body = document.getElementsByTagName("body");
    body.style.color = color;
  }
};

// Crear una función cambiarColorDeFondoDelBody. Que reciba como
// parámetro un String (nombre del color ó valor hexadecimal) y que
// cambie el color de fondo de la etiqueta <body>. El cambio sólo deberá
// realizarse, si el valor pasado como parámetro es diferente a green ó
// #0f0 ó #00ff00. Si el cambio de color es posible, la función retornará
// true. De lo contrario retornará false.
// . Ejecutar la función y pasarle como parámetros diferentes valores.
// a. Mostrar en consola si el cambio de color fue posible.

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

const changeBodyBackgroundColor = document.getElementById("changeColorButton");

changeBodyBackgroundColor.addEventListener('click', () => {

  let color = document.getElementById("changeColor").value;

  if (color == "#0f0" || color == "#00ff00" || color == "green") {
    console.log(false);
  } else {
    document.body.style.backgroundColor = color;
    console.log(true);
  }
}) 

//Ejercicio 3

const changeParagraphs = document.getElementById("paragraphsButton");

changeParagraphs.addEventListener("click", () => {

  let paragraphs = document.querySelectorAll(".exercise3 p");
  let counter = 1;
  for (let i = 0; i < paragraphs.length; i++) {
    if (i % 2 == 0) {
      paragraphs[i].style.color = "red";
      paragraphs[i].style.fontWeight = "bold";
      paragraphs[i].style.textAlign = "center";
      counter++;
    }
  }
  console.log(paragraphs.length - counter);
});


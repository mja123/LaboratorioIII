window.addEventListener("load", async (event) => {
  event.preventDefault();
  try {
    let request = await fetch(
      "http://localhost/finalProject/admin/controller/Validate.php", {
        method: "GET",
      }
    );
    let answer = await request.json();

    if (answer["error"] != undefined) {
      throw new Error(answer["error"]);
    }
  } catch (e) {
    window.location.replace(
      "http://localhost/finalProject/login/view/login.html"
    );
  }
});

const createEvent = document.getElementById("createButton");
createEvent.addEventListener("click", async (event) => {
  event.preventDefault();
 
  removeMessages();

  let input = validateInput("create");

  if (input != null) {
    const data = {
      "name": input.name,
      "table": input.table,
      "description": input.description,
      "vegetarian": input.vegetarian,
      "price": input.price,
      "action": "create"
    }

    try {
    const request = await fetch(
      "http://localhost/finalProject/admin/controller/Admin.php",
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
    console.log(request)
    let body = await request.json();
    console.log(body);
    if (body["error"] != undefined) {
      throw new Error(body["error"]);
    }

    showMessage("creado");

    } catch (e) {
    if (!document.body.contains(document.getElementById("errorRequest"))) {
      let errorAnswer = document.createElement("p");

      errorAnswer.setAttribute("id", "errorRequest");
      errorAnswer.setAttribute("class", "d-flex justify-content-center form");
      errorAnswer.innerHTML = e;
      errorAnswer.style.color = "white";
      document.body.append(errorAnswer);
    }
    }
  }
});

const readEvent = document.getElementById("readButton");
readEvent.addEventListener("click", async (event) => {
  event.preventDefault();

  removeMessages();

  let input = validateInput("read");

  if (input != null) {
    const data = {
      "name": input.name,
      "table": input.table,
      "action": "read"
    }
    try {
      const request = await fetch(
        "http://localhost/finalProject/admin/controller/Admin.php", {
          method: "POST",
          body: JSON.stringify(data),
        }
      );
      console.log(request)
      let body = await request.json();
      if (body["error"] != undefined) {
        throw new Error(body["error"]);
      }

      showDish(body);
    } catch (e) {
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        let errorAnswer = document.createElement("p");

        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "d-flex justify-content-center form");
        errorAnswer.innerHTML = e;
        errorAnswer.style.color = "white";
        document.body.append(errorAnswer);
      }
    }
  }
});

const deleteEvent = document.getElementById("deleteButton");
deleteEvent.addEventListener("click", async (event) => {
  event.preventDefault();

  removeMessages();

  let input = validateInput("delete");

  if (input != null) {
    try {
      const data = {
        "name": input.name,
        "table": input.table,
        "action": "remove"
      }
      
      const request = await fetch(
        "http://localhost/finalProject/admin/controller/Admin.php", {
          method: "POST",
          body: JSON.stringify(data),
        }
      );
      console.log(request)
      let body = await request.json();

      if (body["error"] != undefined) {
        throw new Error(body["error"]);
      }

      showMessage("eliminado");
    } catch (e) {
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        let errorAnswer = document.createElement("p");

        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "d-flex justify-content-center form");
        errorAnswer.innerHTML = e;
        errorAnswer.style.color = "white";
        document.body.append(errorAnswer);
      }
    }
  }
});

const updateEvent = document.getElementById("updateButton");
updateEvent.addEventListener("click", async (event) => {
  event.preventDefault();
 
  removeMessages();
  console.log("here")
  let input = validateInput("update");

  if (input != null) {
    console.log(JSON.stringify(input))

    try {
    const request = await fetch(
      "http://localhost/finalProject/admin/controller/Admin.php",
      {
        method: "POST",
        body: JSON.stringify(input),
      }
    );
    console.log(request)
    let body = await request.json();
    console.log(body);
    if (body["error"] != undefined) {
      throw new Error(body["error"]);
    }

    showMessage("modificado");

    } catch (e) {
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        let errorAnswer = document.createElement("p");

        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "d-flex justify-content-center form");
        errorAnswer.innerHTML = e;
        errorAnswer.style.color = "white";
        document.body.append(errorAnswer);
      }
    }
  }
});

//TODO: Refactor this and return an object and use it to send the request to
//TODO: Create a function that evaluates if the value is greater than zero and modifies data object
const validateInput = (action) => {
  let name = document.getElementById("name").value;
  let table = document.getElementById("table").value;
  let description = document.getEelementById("description").value 
  let vegetarian = document.getEelementById("vegetarian").value 
  let price = document.getElementById("price").value;
  
  
  if (name.length > 0 && table.length > 0) {
    return null
  } 

  let data = {}
  data.name = name
  data.table = table

  switch (action) {
    case "create":
      if (description.length > 0 && price.length > 0 && vegetarian.length > 0) {
        data.description = description
        data.price = price
        data.vegetarian = vegetarian
      }
    case "update":
      
    case "delete":
    default:
      break
  }

  return data
}

//   if (name.length > 0 && table.length > 0 && action == "delete" || action == "read") {
//     return {
//       name,
//       table,
//     };
//   } else if (name.length > 0 && table.length > 0 && action == "create") {
//     if (
//       price > 0 &&
//       description.length > 0 &&
//       (vegetarian == 1 || vegetarian == 0)
//     ) {
//       return {
//         name,
//         table,
//         price,
//         description,
//         vegetarian,
//       };
//     }
//     //TODO: refactor this code and split to a different response function
//       if (!document.body.contains(document.getElementById("emptyName"))) {
//         let errorAnswer = document.createElement("p");

//         errorAnswer.setAttribute("id", "emptyName");
//         errorAnswer.setAttribute("class", "d-flex justify-content-center form");
//         errorAnswer.innerHTML =
//           "Debes ingresar correctamente todos los datos...";
//         errorAnswer.style.color = "white";
//         document.body.append(errorAnswer);
//       }
//       return null;

//   } else if (name.length > 0 && table.length > 0 && action == "update") {
//     let input = {}
  
//     if (description.length > 0) {
//       input.description = description
//     }
//     if (vegetarian.length > 0) {
//       input.vegetarian = vegetarian
//     }
    
//     input.price = price
//     input.name = name
//     input.table = table
//     input.action = action
//     return input
//   } else {
//     if (!document.body.contains(document.getElementById("emptyName"))) {
//       let errorAnswer = document.createElement("p");

//       errorAnswer.setAttribute("id", "emptyName");
//       errorAnswer.setAttribute("class", "d-flex justify-content-center form");
//       errorAnswer.innerHTML =
//         "Debes ingresar el nombre y el tipo de un plato...";
//       errorAnswer.style.color = "white";
//       document.body.append(errorAnswer);
//     }
//     return null;
//   }
// };

const showMessage = (method) => {
  let message = document.createElement("p");

  message.setAttribute("id", "message");
  message.setAttribute("class", "d-flex justify-content-center form");
  message.innerHTML = `El plato se ha ${method} con éxito.`;
  message.style.color = "white";
  document.body.append(message);
};

const showDish = (data) => {
  let wrapper = document.getElementById("wrapper");

  let section = document.createElement("section");
  let name = document.createElement("p");
  let description = document.createElement("p");
  let price = document.createElement("p");
  let vegetarian = document.createElement("p");

  section.setAttribute("class", "container");
  section.setAttribute("id", "getMessage")
  wrapper.append(section);

  name.innerHTML = `Nombre: ${data[0]["name"]}`;
  description.innerHTML = `Descipción: ${data[0]["description"]}`;
  price.innerHTML = `Precio: $${data[0]["price"]}`;
  if (data[0]["vegetarian"] == "1") {
    vegetarian.innerHTML = `Vegetariano`;
  } else {
    vegetarian.innerHTML = `No vegetariano`;
  }
  

  name.style.color = "white"; 
  description.style.color = "white"; 
  price.style.color = "white"; 
  vegetarian.style.color = "white";

  name.setAttribute("class", "col");
  description.setAttribute("class", "col");
  price.setAttribute("class", "col");
  vegetarian.setAttribute("class", "col");

  section.appendChild(name);
  section.appendChild(description);
  section.appendChild(price);
  section.appendChild(vegetarian);
};

const removeMessages = () => {

  if (document.body.contains(document.getElementById("getMessage"))) {
    let wrapper = document.getElementById("wrapper");
    wrapper.removeChild(document.getElementById("getMessage"));
  }
  if (document.body.contains(document.getElementById("message"))) {
    document.body.removeChild(document.getElementById("message"));
  }
  
  if (document.body.contains(document.getElementById("errorRequest"))) {
    document.body.removeChild(document.getElementById("errorRequest"));
  }
  
  if (document.body.contains(document.getElementById("emptyName"))) {
    document.body.removeChild(document.getElementById("emptyName"));
  }
}
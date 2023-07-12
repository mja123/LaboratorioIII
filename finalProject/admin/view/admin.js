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

  let input = await validateInput("create");

  if (input != null) {
    console.log(input["image"])
    input.action = "create";
    try {
    const request = await fetch(
      "http://localhost/finalProject/admin/controller/Admin.php",
      {
        method: "POST",
        body: JSON.stringify(input),
      }
    );
    let bodyText = await request.text()
    let body = await JSON.parse(bodyText)
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
        errorAnswer.innerHTML = "Error en la creación del plato! Por favor, revise los datos ingresados.";
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

  let input = await validateInput("read");

  if (input != null) {
    input.action = "read";

    try {
      const request = await fetch(
        "http://localhost/finalProject/admin/controller/Admin.php", {
          method: "POST",
          body: JSON.stringify(input),
        }
      );
      console.log(request)
      let bodyText = await request.text()
      let body = await JSON.parse(bodyText)
      if (body["error"] != undefined) {
        throw new Error(body["error"]);
      }
      showDish(body);
    } catch (e) {
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        let errorAnswer = document.createElement("p");

        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "d-flex justify-content-center form");
        // errorAnswer.innerHTML = "Plato no encontrado.";
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

  let input = await validateInput("delete");

  if (input != null) {
    try {
      input.action = "delete";
      
      const request = await fetch(
        "http://localhost/finalProject/admin/controller/Admin.php", {
          method: "POST",
          body: JSON.stringify(input),
        }
      );
      console.log(request)
      let bodyText = await request.text()
      let body = await JSON.parse(bodyText)

      if (body["error"] != undefined) {
        throw new Error(body["error"]);
      }

      showMessage("eliminado");
    } catch (e) {
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        let errorAnswer = document.createElement("p");

        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "d-flex justify-content-center form");
        errorAnswer.innerHTML = "Plato no encontrado.";
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
  
  let input = await validateInput("update");

  if (input != null) {
    input.action = "update";

    try {
    const request = await fetch(
      "http://localhost/finalProject/admin/controller/Admin.php",
      {
        method: "POST",
        body: JSON.stringify(input),
      }
    );
    console.log(request)
    let bodyText = await request.text()
    let body = await JSON.parse(bodyText)
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
        errorAnswer.innerHTML = "Error al modificar el plato. Por favor, revise los dataos ingresados.";
        errorAnswer.style.color = "white";
        document.body.append(errorAnswer);
      }
    }
  }
});

const validateInput = async (action) => {
  let name = document.getElementById("name").value;
  let table = document.getElementById("table").value;
  let description = document.getElementById("description").value 
  let vegetarian = document.getElementById("vegetarian").value 
  let price = document.getElementById("price").value;
  let image = document.getElementById("image").files[0]
  let imageData
  if (image != undefined) {
    imageData = await readFileDataAsBase64(image);
  }

  console.log("Image: " + imageData)
  
  if (name.length == 0 || table.length == 0) {
    errorMessage("Debes ingresar nombre y tabla.")
    return null
  } 

  let data = {}
  data.name = name
  data.table = table

  switch (action) {
    case "create":
      if (description.length == 0 || price.length == 0 || vegetarian.length == 0 || imageData != undefined) {
        errorMessage("Debes ingresar todos los datos...")
        return null
      }
      data.description = description
      data.price = price
      if (validateVegetarian(vegetarian) == null) {
        return null
      }
      data.vegetarian = vegetarian
      data.image = imageData
      break
    case "update":
      let changes = 0
      if (description.length > 0) {
        data.description = description
        changes++
      }
      if (price.length > 0) {
        data.price = price
        changes++
      }
      if (vegetarian.length > 0) {
        if (validateVegetarian(vegetarian) == null) {
          return null
        } 
        data.vegetarian = vegetarian
        changes++
      }
      if (imageData != undefined) {
        data.image = imageData
        changes++
      }
      if (changes == 0 ) {
        errorMessage("Debes ingresar al menos un cambio.")
        return null
      }
      break
  }
  console.log(data)
  return data
}

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
  console.log("Show Dish")

  let section = document.createElement("section");
  let name = document.createElement("p");
  let description = document.createElement("p");
  let price = document.createElement("p");
  let vegetarian = document.createElement("p");
  let image = document.createElement("img");

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

  // image.setAttribute("width", 50)
  // image.setAttribute("height", 100)

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

  if (image != undefined) {
    image.src= data[0]["image"];
    image.setAttribute("class", "img-fluid");
    section.appendChild(image)
  }
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

const validateVegetarian = (value) => {
  value = value.toLowerCase();
  console.log("Vegetaiano: " + value);
  if (value == "1" || value == "true" || value == "yes" || value == "si") {
    return "1"
  } else if (value == "0" || value == "false"  || value == "no") {
    return "0"
  } else {
    errorMessage("Debes ingresar 1 o 0.")
    return null
  }
}

const errorMessage = (message) => {
  let error = document.createElement("p");
  error.setAttribute("id", "errorRequest");
  error.setAttribute("class", "d-flex justify-content-center form");
  error.innerHTML = message;
  error.style.color = "white";
  document.body.append(error)
}

const readFileDataAsBase64 = (image) =>
  new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result)
    reader.onerror = () => reject(new Error("Could not load image content"))
    reader.readAsDataURL(image)
  })


// TODO: Fix image size, refactore home page service and clean up data
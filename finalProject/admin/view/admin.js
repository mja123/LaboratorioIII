const createEvent = document.getElementById("createButton");
createEvent.addEventListener("click", () => {
  alert("create");
});

const readEvent = document.getElementById("readButton");
readEvent.addEventListener("click", () => {
  alert("read");

  let input = validateInput();

  if (validateInput != null) {
    input = JSON.stringify(input);
    const url = "http://localhost/finalProject/admin/controller/Admin.php" 
    const headers = new Headers({
      name: input
    })
    baseRequest(url, headers);
  } 
  
});

const deleteEvent = document.getElementById("deleteButton");
deleteEvent.addEventListener("click", () => {
  alert("delete");

});


const validateInput = () => {
  let dish = document.getElementById("name").value;
  if (dish.length > 0) {
    dish = dish.toLowerCase();
    dish = dish.charAt(0).toUpperCase() + dish.slice();
    return dish;
  } else {
    if (!document.body.contains(document.getElementById("emptyName"))) {
      let errorAnswer = document.createElement("p");

      errorAnswer.setAttribute("id", "emptyName");
      errorAnswer.setAttribute("class", "d-flex justify-content-center form");
      errorAnswer.innerHTML = "Debes ingresar el nombre de un plato...";
      errorAnswer.style.color = "white";
      document.body.append(errorAnswer);
    }
    return null;
  }
}
const baseRequest = async (url, data) => {
    try {
      let request = await fetch(
        url, 
        data
      );
      console.log(request);
      let body = await request.json();
      alert(body)
      if (body["error"] != undefined) {
        throw new Exception(body["error"]);
      }

      showResults(body);
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
  
};

window.addEventListener("load", async (event) => {
  event.preventDefault();
  try {
    let request = await fetch("http://localhost/finalProject/menu/menu.php", {
      method: "GET",
    });
    let answer = await request.json();

    if (answer["error"] != undefined) {
      throw new Error(answer["error"]);
    }
    console.log(answer);

    showResults(answer);
  } catch (e) {
    let errorAnswer;
    if (!document.body.contains(document.getElementById("errorRequest"))) {
      errorAnswer = document.createElement("p");
      errorAnswer.setAttribute("id", "errorRequest");
      errorAnswer.setAttribute("class", "container");
    } else {
      errorAnswer = document.getElementById("errorRequest");
    }
    errorAnswer.innerHTML = e.message;
    errorAnswer.style.color = "white";
    document.body.append(errorAnswer);
  }
});

const showResults = (data) => {
  let lastId;
  let sections = 1;
  let br = document.createElement("br");

  for (let i = 0; i < data.length; i++) {
    let wrapper = document.getElementById("wrapper");

    if (i == 0) {
      let starters = document.createElement("h2");
      starters.setAttribute("class", "col-12");
      starters.innerHTML = "Entradas";
      wrapper.append(starters);
      lastId = data[0]["id"];
      wrapper.append(br);
    }
    if (data[i]["id"] <= lastId && i != 0) {
      if (sections == 1) {
        let mainCourses = document.createElement("h2");
        mainCourses.setAttribute("class", "col-12");
        mainCourses.innerHTML = "Platos principales";
        wrapper.append(mainCourses);
        wrapper.append(br);
      } else {
        let desserts = document.createElement("h2");
        desserts.setAttribute("class", "col-12");
        desserts.innerHTML = "Postres";
        wrapper.append(desserts);
        wrapper.append(br);
      }
      sections++;
    }

    let name = document.createElement("h4");
    let description = document.createElement("p");
    let price = document.createElement("p");

    name.setAttribute("class", "col-8");
    price.setAttribute("class", "col-4 price");
    description.setAttribute("class", "col-12 description");

    name.innerHTML = data[i]["name"];
    description.innerHTML = data[i]["description"];
    price.innerHTML = "$" + data[i]["price"];

    wrapper.appendChild(name);
    wrapper.appendChild(price);
    wrapper.appendChild(description);

    lastId = data[i]["id"];
  }
};

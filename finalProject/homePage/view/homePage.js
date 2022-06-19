const dataValidate = () => {
  let price = document.getElementById("price").value;

  if (price < 0 || price > 1000000) {
    if (!document.body.contains(document.getElementById("errorPrice"))) {
      let errorAnswer = document.createElement("p");

      errorAnswer.setAttribute("id", "errorPrice");
      errorAnswer.setAttribute("class", "container");
      errorAnswer.innerHTML = "El precio ingresado se encuentra fura de rango.";
      errorAnswer.style.color = "white";
      document.body.append(errorAnswer);

      document.getElementById("price").value = "";
      return false;
    }
    document.getElementById("price").value = "";
    return false;
  } else {
    if (document.body.contains(document.getElementById("errorPrice"))) {
      document.getElementById("errorPrice").remove();
    }
    return true;
  }
};

const form = document.getElementById("filterForm");

form.addEventListener("submit", async (event) => {
  event.preventDefault();
  const data = fillFormData();

  try {
    
    let request = await fetch(
      "http://localhost/finalProject/homePage/controller/HomePage.php",
      {
        method: "POST",
        body: data,
      }
      );
      let answer = await request.json();

      if (answer["error"] != undefined) {
        throw new Error(answer["error"]);
      }
      
      console.log(answer)
      window.location.replace(`http://localhost/finalProject/homePage/view/filter/filter.html?data=${answer}`);
      //showResults(answer);
    } catch (e) {
      let errorAnswer
    if (!document.body.contains(document.getElementById("errorRequest"))) {
      
      errorAnswer = document.createElement("p");
      errorAnswer.setAttribute("id", "errorRequest");
      errorAnswer.setAttribute("class", "container");
    } else {
      errorAnswer = document.getElementById("errorRequest")
    }
      errorAnswer.innerHTML = e.message;
      errorAnswer.style.color = "white";
      document.body.append(errorAnswer);
  }
});

const fillFormData = () => {
  const data = new FormData();
  
  const type = document.querySelector('input[name="type"]:checked');
  if (type != null) {
    data.append("type", type.value)
     
  }
  if (document.getElementById("price").value != 0) {
    data.append("price", document.getElementById("price").value)
  }
  if (document.getElementById("vegetarian").checked) {
    data.append("vegetarian", 1)
  } else {
    data.append("vegetarian", 0)
  }
  return data;

}

// const showResults = (data) => {
//   const result = document.getElementById("result");
  
//   const pPrice = document.createElement("p");
//   const pDescription = document.createElement("p");
//   const pName = document.createElement("p");
  
//   const countOfElements = Object.keys(data).length;
//   const lengthOfPage = 4;
//   const countOfPages = Math.ceil(countOfElements / lengthOfPage);
//   data = JSON.parse(data);

//   console.log(data[0]["name"], data[0]["description"], data[0]["price"])
  
//   if (countOfPages > 1) {
//     for(let i = 0; i < lengthOfPage; i++) {
//       let name = data[i]["name"]
//       let description = data[i]["description"];
//       let price = data[i]["price"]
//       pName.innerHTML += name;
//       pDescription.innerHTML += description;
//       pPrice.innerHTML += price;

//       result.appendChild(pName);
//       result.appendChild(pDescription);
//       result.appendChild(pPrice);
//       result.appendChild(document.createElement("br"));
//     }

//   }
//   pData.style.color = "white";
// };



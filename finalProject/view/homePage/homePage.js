const priceValidate = () => {
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
      return true
    };
  };
  
const filterResults = () => {
    let cookie = document.cookie;
    let data = document.createElement("p");
    data.innerHTML = cookie;
    document.body.append(data);

}
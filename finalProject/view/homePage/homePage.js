const dataValidate = document.getElementById("filterForm").addEventListener(
  "submit", () => {
    let price = document.getElementById("price").value;
    let vegetarian = document.getElementById("vegetarian").value;
    //const types = document.getElementById("type").value;
    //console.log(types);
    //let type = Array.from(types).find((t) => t.checked);

    if (!price == any) {
      if (price <= 0 || price > 1000000) {
          console.log("gere")
        let errorAnswer = document.createElement("p");
        errorAnswer.innerHTML = "El precio ingresado se encuentra fura de rango.";
        document.body.append(errorAnswer);
        return null;
      }
    } else {
      console.log({
        //type,
        price,
        vegetarian,
      });
      return {
        //type,
        price,
        vegetarian,
      };
    }
  }
);

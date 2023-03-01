const login = document.getElementById("login");

login.addEventListener("submit", async (event) => {
  event.preventDefault();

  let userName = document.getElementById("userName").value;
  let password = document.getElementById("password").value;

  if (checkData(userName, password)) {
    try {
      let data = {
        "username": userName,
        "password": password
      }

      let request = await fetch(
        "http://localhost/finalProject/login/Login.php", {
          method: "POST",
          body: JSON.stringify(data)
        }
      );

      console.log(request)
      let answer = await request.json()

      if (answer["error"] != undefined) {
        throw new Error(answer["error"]);
      }
      
      window.location.replace(
        "http://localhost/finalProject/admin/view/admin.html"
      );

    } catch (e) {
      let errorAnswer;
      console.log(e)
      if (!document.body.contains(document.getElementById("errorRequest"))) {
        errorAnswer = document.createElement("p");
        errorAnswer.setAttribute("id", "errorRequest");
        errorAnswer.setAttribute("class", "container");
      } else {
        errorAnswer = document.getElementById("errorRequest");
      }
      errorAnswer.innerHTML = "Admin no encontrado.";
      errorAnswer.style.color = "white";
      document.body.append(errorAnswer);
    }
  }
});

const checkData = (userName, password) => {
  if (userName.length > 0 && password.length > 0) {
    return true;
  }
  if (!document.body.contains(document.getElementById("wrapper"))) {
    let pWrapper = document.createElement("p");
    let emptyData = document.createElement("span");

    pWrapper.setAttribute("id", "wrapper");
    document.body.append(pWrapper);

    emptyData.setAttribute("id", "emptyData");
    emptyData.setAttribute("class", "form");
    emptyData.innerHTML = "Debes completar con tus datos antes de enviar.";

    pWrapper.append(emptyData);
  }

  return false;
};

const checkData = () => {
  let userName = document.getElementById("userName").value;
  let password = document.getElementById("password").value;

  if (userName != null && password != null) {
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


const errorMessage = (e) => {
  console.log("sdffffff");
  let spanWrapper = document.createElement("span");
  let error = document.createElement("p");

  spanWrapper.setAttribute("id", "error");
  document.body.append(spanWrapper);

  error.setAttribute("id", "emptyData");
  error.setAttribute("class", "form");
  error.innerHTML = e;

  spanWrapper.append(error);
};

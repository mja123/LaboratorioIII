const initialize = () => {
  if (!confirm("¿Quieres iniciar?")) {
    alert("Gracias por haber venido");
    window.location.href = "https://www.netflix.com/";
    return false;
  }
  return true;
};

const members = () => {
  let familyMembers = 0;
  while (familyMembers < 3) {
    familyMembers = parseInt(
      prompt("Ingrese la cantidad de integrantes de la familia: ")
    );

    if (!isNaN(familyMembers)) {
      if (familyMembers < 3) {
        alert("Deben ser mínimo 3 integrantes.");
      }
    } else {
      alert("Debe ingresar un número. Ingréselo nuevamente: ");
      familyMembers = 0;
    }
  }
  return familyMembers;
};

const familyData = (familyMembers) => {
  let data = [];
  for (let i = 0; i < familyMembers; i++) {
    let memberName = "";
    let spentMoney;
    let correctInput = false;

    do {
      memberName = String(
        prompt(`Ingrese el nombre del integrante n° ${i + 1}: `)
      );
      if (memberName.length > 0) {
        correctInput = true;
      } else {
        alert("Ingrese su nombre...");
      }
    } while (!correctInput);

    do {
      correctInput = false;
      spentMoney = parseInt(prompt(`Ingrese los gastos de ${memberName}: `));
      if (!(isNaN(spentMoney) || spentMoney.length === 0 || spentMoney < 0)) {
        correctInput = true;
      } else {
        alert("Debe ingresar un número positivo.");
      }
    } while (!correctInput);
    let memberData = {
      Nombre: memberName,
      Gastos: spentMoney,
    };
    data.push(memberData);
  }

  let maxMoney = data[0];
  data.forEach((p) => {
    p.Gastos > maxMoney.Gastos && (maxMoney = p);
  });
  console.log(maxMoney);
  console.log(data);
  return data;
};

const createTitle = () => {
  let title = document.createElement("h1");
  title.innerText = "Reporte de gastos familiares";
  document.body.append(title);
};

const spentList = (data) => {
  let maxMoney = data[0];
  let minMoney = data[0];
  let accumulator = 0;
  data.forEach((p) => {
    p.Gastos > maxMoney.Gastos && (maxMoney = p);
    p.Gastos < minMoney.Gastos && (minMoney = p);
    accumulator += p.Gastos;
  });

  let unorderList = document.createElement("ul");
  unorderList.setAttribute("id", "moneyData");
  document.body.append(unorderList);

  let maxMoneyItem = document.createElement("li");
  let minMoneyItem = document.createElement("li");
  let averageMoneyItem = document.createElement("li");

  maxMoneyItem.textContent = `Quien más gastó fue: ${maxMoney.Nombre} con un total de: $${maxMoney.Gastos}`;
  maxMoneyItem.setAttribute("title", "maxMoney");

  minMoneyItem.textContent = `Quien menos gastó fue: ${minMoney.Nombre} con un total de: $${minMoney.Gastos}`;
  minMoneyItem.setAttribute("title", "minMoney");

  averageMoneyItem.textContent = `El promedio de gastos fue: $${
    accumulator / data.length
  }`;
  averageMoneyItem.setAttribute("title", "average");
  unorderList.append(maxMoneyItem, minMoneyItem, averageMoneyItem);
};

const budget = (totalMoney) => {
  let fixedBudget = 1200;

  let compareBudget = document.createElement("button");
  compareBudget.setAttribute("id", "budget");
  compareBudget.innerText = "¿Nos pasamos del presupuesto?";
  document.body.append(compareBudget);

  let answer = document.createElement("p");
  answer.setAttribute("id", "answer");
  compareBudget.setAttribute("type", "button");

  compareBudget.addEventListener("click", () => {
    if (fixedBudget < totalMoney) {
      answer.textContent = "El presupesto diario fue superado!!!";
      answer.style.fontSize = "xx-large";
      answer.style.color = "red";
    } else {
      answer.textContent = "No hemos superado el presupuesto diario.";
    }
  });

  document.body.append(answer);
};

const helpMessage = () => {
  let button = document.getElementById("budget");
  let message = document.createElement("p");

  message.textContent = "¿Necesitas ayudar?";
  message.setAttribute("id", "helpMessage");
  message.style.display = "none";

  let answer = document.getElementById("answer");
  document.body.insertBefore(message, answer);

  button.addEventListener("mouseover", () => {
    message.style.display = "block";
  });

  button.addEventListener("mouseout", () => {
    setTimeout(() => {
      message.style.display = "none";
    }, 3000);
  });
};

const darkMode = () => {
  let darkModeButton = document.createElement("button");
  darkModeButton.setAttribute("mode", "light");
  darkModeButton.textContent = "Cambiar tema";
  document.body.append(darkModeButton);

  darkModeButton.addEventListener("click", () => {
    if (darkModeButton.getAttribute("mode") == "light") {
      document.body.style.backgroundColor = "#262B29";
      document.body.style.color = "white";
      darkModeButton.setAttribute("mode", "dark");
    } else {
      document.body.style.backgroundColor = "white";
      document.body.style.color = "black";
      darkModeButton.setAttribute("mode", "light");
    }
  });
};

const secret = () => {
  let secretMessage = document.createElement("p");
  document.body.append(secretMessage);
  secretMessage.textContent = "Oh, encontraste el secreto!";
  secretMessage.style.display = "none";

  document.onkeypress = (event) => {
    if (String.fromCharCode(event.which) == "q") {
      secretMessage.style.display = "block";
    }
  };
};
if ((window.onload = initialize())) {
  let countOfMembers = members();
  let data = familyData(countOfMembers);

  createTitle();

  spentList(data);

  let accumulator = 0;
  data.forEach((p) => {
    accumulator += p.Gastos;
  });

  budget(accumulator);
  helpMessage();
  darkMode();
  secret();
}

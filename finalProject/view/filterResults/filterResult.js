const cookies = () => {
    let cookie = document.cookie;
    let data = document.createElement("p");
    data.innerHTML = cookie;
    document.body.append(data);
}
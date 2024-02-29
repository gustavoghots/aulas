document.getElementById("botao").addEventListener("click", function(event){
    event.preventDefault();

    const date = new Date();
    var data = date.toLocaleDateString();
    var hora = date.toLocaleTimeString();

    document.getElementById("texto").innerHTML = "data: "+data+"<br> hora: "+hora;
});
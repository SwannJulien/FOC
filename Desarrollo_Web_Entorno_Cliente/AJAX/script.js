// Llama a la función loadXMLDoc() cuando se pulsa el bottón
const button = document.getElementById("button");
button.addEventListener("click", loadXMLDoc);

// Crea una conexion XMLHttpRequest
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://foc-dwes.epizy.com/dwec/07/catalogo_cd/catalogo.xml", true);
  xhttp.onreadystatechange = stateChange;
  xhttp.send();

  // Carga los datos de la URL pasado en parametro del método xhttp.open(), crea tanta etiqueta <option> como hay de artistas y los vuelca dentro de la etiqueta <select>
  function stateChange(evento) {
    // Comprueba que la conexion se ha establecida y la respuesta del servidor ha sido correcta
    if (evento.target.readyState == 4 && evento.target.status == 200) {
      // Se cargan todos los artistas en la variable artistas
      var docXML = xhttp.responseXML;
      var artistas = docXML.getElementsByTagName("ARTIST");
      var autores = document.getElementById("autores");
      // Para cada artista, se crea una etiqueta <option> que se añade al html como hijo de <select>
      for (let i = 0; i < artistas.length; i++) {
        var opt = document.createElement("option");
        var artista = document.createTextNode(artistas[i].textContent);
        opt.appendChild(artista);
        autores.appendChild(opt);
      }
    }
  }
}

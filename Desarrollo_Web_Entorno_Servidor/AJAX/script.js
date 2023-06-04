// Se lanza la función procesar cada vez que una tecla presionada en el input de búsqueda se libere
var texto = document.getElementById("texto");
const log = document.getElementById("log");
texto.addEventListener("keyup", procesar);
// Variable keys se usará en la función procesar
var keys = "";

// Input de būsqueda debe empezar por letras seguido de letras o espacios
function testRegex(key) {
  var regex = /^[a-zA-Z]+[a-zA-Z\s]*$/;
  var result = regex.test(key) ? true : false;
  return result;
}

// Resetea la pagina en caso de que se haya lanzado otra consulta antes
function resetTable() {
  var firstDiv = document.getElementById("hide");
  // Comprueba que firstDiv existe
  if (typeof firstDiv != "undefined" && firstDiv != null) {
    firstDiv.remove();
  }
}

// Crea un parafo con text => sirve para enseñar el mensaje de error
function crearParafo(text) {
  var p = document.createElement("p");
  var pText = document.createTextNode(text);
  p.appendChild(pText);
  document.body.appendChild(p);
}

// Si existe alguna fila se elimina todos los nodos hijos de la tabla => permite reiniciar la busqueda
function reiniciarBusqueda() {
  var tr = document.getElementsByTagName("tr")[0];
  if (typeof tr != "undefined" && tr != null) {
    while (table.firstChild) {
      table.removeChild(table.firstChild);
    }
  }
}

// Comprueba si el objeto query tiene datos. Si query tiene datos, se lanza la funcion mostrarSugerencias. Si no muestra un mensaje de error.
function existeDatos(query) {
  if (query && Object.keys(query).length !== 0 && query.constructor !== Object) {
    reiniciarBusqueda();
    query.forEach(mostrarSugerencias);
  } else {
    reiniciarBusqueda();
    crearParafo("No hay libro que corresponda con su búsqueda. Pulse Reset para lanzar una nueva consulta");
  }
}

function procesar(event) {
  // Elimina el contenido de la pagina
  resetTable();
  // Concatena cada caracter teclado en una variable
  keys += event.key;
  // Si la cadena de caracteres es valida, se lanza la conexion XMLHTTPRequest
  if (testRegex(keys)) {
    // Conexion a api.php y se pasa en parametro de la funcion buscar_libro la cadena keys
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/dwes/08/local/src/api.php?action=buscar_libro&nombre=" + keys, true);
    xhttp.send();
    xhttp.onreadystatechange = stateChange;
    function stateChange() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        var resultado = window.JSON.parse(xhttp.responseText);
        existeDatos(resultado);
      }
    }
  } else {
    crearParafo("Escriba solo letras. Pulse Reset para lanzar una nueva consulta");
  }
}

// Crea la tabla con los resultados de la busqueda
function mostrarSugerencias(libro) {
  var tr = document.createElement("tr");
  var td1 = document.createElement("td");
  var td2 = document.createElement("td");
  var text1 = document.createTextNode(libro.id);
  var text2 = document.createTextNode(libro.titulo);
  td1.appendChild(text1);
  td2.appendChild(text2);
  tr.appendChild(td1);
  tr.appendChild(td2);
  table.appendChild(tr);
}

// Crea la tabla que recibira los datos de la funcion mostrar Sugerencias
var div = document.createElement("div");
var table = document.createElement("table");
var firstDiv = document.getElementsByTagName("div")[0];
firstDiv.appendChild(div);
div.appendChild(table);
var att = document.createAttribute("class");
att.value = "center";
div.setAttributeNode(att);

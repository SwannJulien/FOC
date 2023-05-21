let button = document.getElementById("button");

// Cuando se pulsa el boton, se lanza la función toggle
button.addEventListener("click", toggle);

// La función toggle activa o desactiva una clase llamada "active" que a su vez cuando está activada llama a la función "crearContenido"
function toggle() {
  let buttonClass = button.classList;
  let result = buttonClass.toggle("active");

  if (result) {
    crearContenido();
  } else location.reload();
}

function crearContenido() {
  // Crea un elemento h1 que contiene un nodo hijo text
  var h1 = document.createElement("h1");
  var h1_text = document.createTextNode("Encabezado dinámico");
  h1.appendChild(h1_text);

  // Crea un elemento hr
  var hr = document.createElement("hr");

  // Crea un elemento parafo
  var div = document.createElement("div");
  var p = document.createElement("p");
  var p_text = document.createTextNode("Párrafo creado dinámicamente");
  p.appendChild(p_text);
  div.appendChild(p);

  // Se apunta al elemento body
  var body = document.getElementsByTagName("body")[0];

  // Dentro del nodo body, antes del nodo button, se insertan los nodos h1 y hr
  body.insertBefore(h1, button);
  body.insertBefore(hr, button);
  body.insertBefore(div, button);

  // Modifica el atributo href del elemento a => Wilkipedia.es
  var a = document.getElementsByTagName("a")[0];
  a.setAttribute("href", "https://www.wikipedia.org/");

  // Modifica el texto del elemento a
  a.firstChild.nodeValue = "Ir a Wilkipedia";
}

var meme = document.getElementById("meme");
var content = document.getElementById("content");
var p_title = document.getElementById("title");
var p_author = document.getElementById("author");

var title = document.createTextNode("");
var author = document.createTextNode("");

p_title.appendChild(title);
p_author.appendChild(author);

meme.addEventListener("submit", procesar);

function procesar(evt) {
  evt.preventDefault();
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/dwes/09/memeAPI.php?action=generateMeme", true);
  xhr.send();
  xhr.onreadystatechange = stateChange;
  function stateChange() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var resultado = window.JSON.parse(xhr.responseText);
      console.log(resultado);
      var img = document.getElementById("img");
      var src_attr = img.setAttribute("src", resultado.url);
      var alt_attr = img.setAttribute("alt", "dailymeme");

      title.nodeValue = "Titulo: " + resultado.title;
      author.nodeValue = "Autor: " + resultado.author;
    }
  }
}

var finger = document.getElementById("finger");
window.addEventListener("load", (event) => {});

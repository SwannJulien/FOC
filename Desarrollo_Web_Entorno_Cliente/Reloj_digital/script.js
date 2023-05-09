// Variables globales que apuntan en el HTML a los diferentes parafos <p> que recibiran la hora
var getHora = document.getElementById("hora");
var getMinuto = document.getElementById("minutos");
var getSegundo = document.getElementById("segundos");

// La función displayHora() recoge la hora completa del dia y la imprime en el documento HTML con el formato HH:MM:SS
function displayHora() {
  var fecha = new Date(); // objeto Date nos da la fecha y hora completa

  // con los métodos siguientes obtenemos la hora, minutos y segundos actuales
  var hora = fecha.getHours();
  var minuto = fecha.getMinutes();
  var segundo = fecha.getSeconds();

  // Condición ternaria para crear el formato HH:MM:SS añadiendo un 0 cuando el número es < 10
  segundo < 10 ? (segundo = "0" + segundo) : segundo;
  minuto < 10 ? (minuto = "0" + minuto) : minuto;
  hora < 10 ? (hora = "0" + hora) : hora;

  // Se cargan en el html la hora, minutos, segundos formateados en HH:MM:SS
  getHora.innerHTML = hora + ":";
  getMinuto.innerHTML = minuto + ":";
  getSegundo.innerHTML = segundo;
}

// La función inicio() llama a la función displayHora() cada segundo (1000ms) creando asi un reloj digital que permite ver el tiempo que pasa
function inicio() {
  setInterval(displayHora, 1000);
}

// La función cerrarVentana() permite cerrar la ventana cuando se llama
function cerrarVentana() {
  var cerrar = window.close();
}

// El método onload del objeto window permite llamar a la función inicio cuando se abre la ventana
window.onload = inicio;

// Comprobar que se entre un número entero
function esEntero(num) {
  if (isNaN(num)) return false;
  else return num % 1 == 0 ? true : false;
}

// Obligar el usuario a entrar un número entero
function promptNum() {
  do {
    var num = prompt("Entre un número entero");
  } while (!esEntero(num));
  return num;
}

// Crear un array del tamaño de la variable N
function crearArray(num) {
  var array = new Array(num);
  alert("Ahora le vamos a pedir que entre " + num + " números enteros");
  for (let i = 0; i < num; i++) {
    var x = promptNum();
    array[i] = x;
  }
  return array;
}

// Ordenar el array del valor más pequeño al valor más grande
function sortArray(array) {
  var sortedArray = array.sort(function (a, b) {
    return a - b;
  });
  return sortedArray;
}

// Retornar el número entrado como parametro si es par
function comprobarPares(num) {
  if (num % 2 == 0) return num;
}
// Retornar el número entrado como parametro si es impar
function comprobarImpares(num) {
  if (num % 2 !== 0) return num;
}

// Desarrollo del programa abajo
var N = promptNum(); // Pedimos al usuario que entre números enteros
var array = crearArray(N); // Creamos un array a partir de los número entrado por el usuario
var sortedArray = sortArray(array); // Ordenamos el array de forma creciente
var arrayPares = sortedArray.filter(comprobarPares); // Filtramos los número pares
var arrayImpares = sortedArray.filter(comprobarImpares); // Filtramos los número impares

// Logs de comprobación
console.log(N);
console.log(array);
console.log(sortedArray);
console.log(arrayPares);
console.log(arrayImpares);

// Imprimir en pantalla las variables arrayPares y arrayImpares
document.getElementById("pares").innerHTML = arrayPares;
document.getElementById("impares").innerHTML = arrayImpares;

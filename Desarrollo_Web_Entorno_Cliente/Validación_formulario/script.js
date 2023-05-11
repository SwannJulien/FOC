// Variables que apuntan a los diferentes elementos requeridos
var usuario = document.getElementById("usuario");
var contrasenia = document.getElementById("contrasenia");
var errorUsuario = document.getElementById("errorUsuario");
var errorContrasenia = document.getElementById("errorContrasenia");
var submit = document.getElementById("submit");

// Expresiones regulares de validación del formulario
var regUsuario = /^[a-zA-Z ,.'-]{3,12}$/;
var regContrasenia = /^[A-Z]{1}[.,-]{1}[a-z0-9]{6}$/;

// Mensajes que se imprimen en pantalla cuando la validación no es correcta
var strErrorUsuario = "El usuario no puede estar vacio y debe tener entre 3 y 12 letras en minuscula.";
var strErrorContrasenia = "La contrasenia no puede estar vacia, debe empezar por una letra en mayuscula seguida de uno de estos tres caracteres especiales punto(.), coma(,) o guion medio(-), y seguido de seis letras en minúscula, o seis números o combinación de ambos (letras y números).";

// Comprobar que los datos cumplen con los requesitos de validación
function validar() {
  if (!regUsuario.test(usuario.value)) {
    // comprobar expresión regular de validación
    errorUsuario.innerHTML = strErrorUsuario; // imprimir mensaje de error
    usuario.className = "active"; // activar la clase que poner un borde rojo al input
  }

  if (!regContrasenia.test(contrasenia.value)) {
    errorContrasenia.innerHTML = strErrorContrasenia;
    contrasenia.className = "active";
  }

  if (regUsuario.test(usuario.value) && regContrasenia.test(contrasenia.value)) {
    location.href = "main.html";
  }
}

submit.addEventListener("click", validar, true);

// Otra versión de la función validar(). En este caso se resaltan los errores de ambos campos si no cumplen los dos con las condiciones de validación.

// function validar() {
//   if (!regUsuario.test(usuario.value) && !regContrasenia.test(contrasenia.value)) {
//     errorUsuario.innerHTML = stErrorUsuario;
//     errorContrasenia.innerHTML = stErrorContrasenia;
//     usuario.className = "active";
//     contrasenia.className = "active";
//   }
//   if (!regUsuario.test(usuario.value)) {
//     errorUsuario.innerHTML = stErrorUsuario;
//     usuario.className = "active";
//   }
//   if (!regContrasenia.test(contrasenia.value)) {
//     errorContrasenia.innerHTML = stErrorContrasenia;
//     contrasenia.className = "active";
//   } else location.href = "main.html";
// }

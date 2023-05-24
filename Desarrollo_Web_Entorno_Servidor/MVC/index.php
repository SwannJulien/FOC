<?php
 /**
 * @author Swann Julien <swann.jn@gmail.com>
 * @date 26/12/2022
 * @title: Controlador frontal index.php
 *
 * CON_CONTROLADOR; variable constante definida a nivel del controlador frontal y permite asegurarse que todas las consultas a plantillas o al modelo pasan previamente por este controlador frontal.
  */

define("CON_CONTROLADOR", true);
require_once "modelo.php";
require_once 'controladores.php';


// Reocge la URI actual y se queda con los ultimos caracteres que siguen el último 
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $path);
$URI = $segments[count($segments)-1];

if ($URI == 'index.php') 
{
    //Controlador especifico de index.php
	controlador_index(); 
}
elseif ($URI == 'articulo' && isset($_GET['id'])) 
{
    // Controlador especifico que muestra los detalles de un articulo en concreto 
    controlador_articulo($_GET['id']); 
}
elseif ($URI == 'resenia')
{
    // Controlador de la pagina de reseñas 
    controlador_resenia();
}
elseif ($URI == 'registro')
{
    // Controlador de la pagina de registro de usuario 
    controlador_registro();
}
else 
{ 
    // Pagina de gestión de errores de URI 
    header('Status: 404 Not Found');
    echo '<html><body><h1>La página a la que intenta acceder no       
          existe</h1></body></html>';
}
?>
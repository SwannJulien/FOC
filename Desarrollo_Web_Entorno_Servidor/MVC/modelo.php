<?php 
/**
 * @author Swann Julien <swann.jn@gmail.com>
 * @date 27/12/2022
 * @title Modelo de la aplicación que simula una llamada a BD
 * 
 * Impide acceder a la BD sin pasar previamente por el controlador
 */
    if(!defined('CON_CONTROLADOR'))
    {
        echo "No se puede acceder a este fichero directamente";
        die();
    }
?>
<?php
/**
 * cargar_datos es la BD de todos los articulos de la aplicación
 *
 * @return array
 */
function cargar_datos()
{
	//Carga de los datos
	$articulos = array(
		0 => array(
			"id" => 0,
			"titulo" => "Caja de aguacates",
			"a_imagen" => "aguacate.jpeg",
			"precio" => "19,90€",
			"descripcion" => "Compra los aguacates de mayor calidad en BeTropicalMyFriend. Este pack contiene 14/15 aguacates (según el tamaño) en el punto idóneo de maduración."),	
		1 => array(
			"id" => 1,
			"titulo" => "Caja de mangos",
			"a_imagen" => "mango.jpeg",
			"precio" => "15,90€",
			"descripcion" => "En BeTropicalMyFriend puedes comprar los mejores mangos al mejor precio. Disfruta de nuestra selección de 8 mangos frescos, recolectados de nuestra planta de maduración en Málaga y saborea el verdadero sabor del mango."),
		2 => array(
			"id" => 2,
			"titulo" => "Caja de papaya y pitaya",
			"a_imagen" => "papaya_pitaya.jpeg",
			"precio" => "24,90€",
			"descripcion" => "En BeTropicalMyFriend te presentamos dos frutas tropicales poco conocidas pero extraordinarias de sabor y de preopiedades saludables: la papaya y la pitaya"),
        3 => array(
            "id" => 3,
            "titulo" => "Caja tropical mix",
            "a_imagen" => "tropical_mix.jpeg",
			"precio" => "27,90€",
			"descripcion" => "La caja perfecta para los enamorados de las frutas tropicales o para hacer une regalo original."),  
	);
	
	return $articulos;
}

/**
 * lista_articulos permite disociar la carga de los datos con la consulta de los mismos
 *
 * @return array
 */
function lista_articulos()
{
    $articulos = cargar_datos();
    return $articulos;
}

/**
 * Retorna los detalles de un articulo en concreto definido por el parametro $id
 *
 * @param  mixed $id
 * @return array 
 */
function articulo($id)
{
	$articulos = cargar_datos();
	$detalles = $articulos[$id];

    return $detalles;
}

/**
 * Retorna un array multidimensional-asociativo conteniendo todas las reseñas de la aplicación
 *
 * @return array
 */
function resenias()
{
	//Obtener usuario y sugerencia
		$listaResenias = array(
		array(
			"usuario" => "Sofia Perez",
			"resenia" => "\"Calidad, frescura, servicio rápido\"",
			"estrella" => "5",
			"foto" => "lady_1.jpeg"),	
		array(
			"usuario" => "Maria del Rio",
			"resenia" => "\"Aguacates riquisimos \"",
			"estrella" => "4",
			"foto" => "lady_2.jpeg"),
		array(
			"usuario" => "John Smith",
			"resenia" => "\"Deberían mejorar la politica de devolución\"",
			"estrella" => "3",
			"foto" => "man_1.jpeg"), 
	);
	
    return $listaResenias;
}

/**
 * Simula la creación en BD de un nuevo usuario
 *
 * @param  mixed $nombre
 * @param  mixed $apellidos
 * @param  mixed $direccion
 * @param  mixed $email
 * @param  mixed $contrasena
 * @return void
 */
function registrar($nombre, $apellidos, $direccion, $email, $contrasena)
{
	//Registrar el nuevo usuario en BD
}

?>
		
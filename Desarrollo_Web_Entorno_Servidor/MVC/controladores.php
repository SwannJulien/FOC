<?php
/**
 * @author Swann Julien <swann.jn@gmail.com>
 * @date 27/12/2022
 * @title controladores relativos al controlador frontal index.php
 */

/**
 * Llama a la plantilla articulos.php y carga los articulos de la BD
 *
 * @return void
 */
function controlador_index()
{
    $articulos = lista_articulos();
    require 'templates/articulos.php';
}

/**
 * Llama a la plantilla detalle_articulo.pho y carga los datos de un articulo en concreto, definido según su $id
 *
 * @param  integer $id
 * @return void
 */
function controlador_articulo($id)
{
    // Petición al modelo para que retorne la lista de artículos de la BD
    $articulo = articulo($id);
    require 'templates/detalle_articulo.php';
}

/**
 * Llama a la plantilla resenias.php. Carga las reseñias de la base de dato y crea un modelo de formulario
 *
 * @return void
 */
function controlador_resenia()
{
    $resenias = resenias();

    // Vamos a seguir el patrón (label, type, name, value)
    $formulario = array (
        array('Respuesta', 'text', 'respuesta', ''),
        array('', 'submit', 'valorar', 'Valorar')
    );

    if(isset($_GET['respuesta']))
    {
        echo "grabar {$_GET['respuesta']}";
    }

    require 'templates/resenias.php';
}

/**
 * controlador_registro llama a la plantilla registro.php que permite a un usuario darse de alta. Los datos entrados por el usuario se comprueban con el validador.php
 *
 * @return void
 */
function controlador_registro()
{
	// Validador de los datos entrados por el usuario
    require 'validadores.php';
	
    // Crea dinamicamente el formulario de registro 
    $formulario = array(
        array('Nombre: ', 'text', 'nombre', ''),
        array('Apellidos: ', 'text', 'apellidos', ''),
        array('Direccion: ', 'text', 'direccion', ''),
        array('Email: ', 'email', 'email', ''),
        array('Contraseña: ', 'password', 'contrasena', ''),
        array('', 'submit', 'registrar', 'Registrarme')
    );
    if(isset($_POST['registrar']))
    {
        if( es_texto($_POST['nombre']) && 
        es_texto($_POST['apellidos']) && 
        es_texto($_POST['direccion']) && 
        es_email($_POST['email']) && 
        es_texto($_POST['contrasena']))
        {
            //Envío de datos al modelo y redirección
            registrar($_POST['nombre'], $_POST['apellidos'], 
                      $_POST['direccion'], $_POST['email'], 
                      $_POST['contrasena']);
			
            require 'templates/registro_correcto.php';	
        }
		else 
		{ 
            // Envia un mensaje de error si uno o varios de los campos no cumplen los requesitos del validador
            if (!es_texto($_POST['nombre']))
            {
                $alert = 'Nombre no es correcto';
            }
            if (!es_texto($_POST['apellidos']))
            {
                $alert = $alert . '<br>' . 'Apellido no es correcto';
            }
            if (!es_texto($_POST['direccion']))
            {
                $alert = $alert . '<br>' . 'Dirección no es correcto';
            } 
            if (!es_email($_POST['email']))
            {
                $alert = $alert . '<br>' . 'Email no es correcto';
            }
            if (!es_texto($_POST['contrasena']))
            {
                $alert = $alert . '<br>' . 'Contraseña no es correcto';
            } 
            require 'templates/registro.php';
		}
    }
	else
    {
        // Carrga por defecto la pagina registro.php
        require 'templates/registro.php';	
	}
}
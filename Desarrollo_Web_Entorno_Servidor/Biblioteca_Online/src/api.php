<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

/**
 * Función conexion permite conectarse a la base de datos a través de PDO
 * @return PDO|null
 */
function conexion() {
    try {
        //Conexión PDO
        $bd = "Libro";
        $host = "localhost";
        $cadenaConexion = "mysql:dbname=$bd;host=$host";
        $usuario = "root";
        $clave = "root";
        $pdo = new PDO(
            $cadenaConexion,
            $usuario,
            $clave,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        return $pdo;

    } catch (PDOException $e) {

        echo 'Fallo en la conexion';
        return null;
    }
}
/**
 * Función get_listado_autores devuelve un array con la lista de los autores de la BDD
 * @return array|null
 */
function get_listado_autores(){
    try {
        $sql = "SELECT * FROM Autor";
        $lectura = conexion()->query($sql);

        if ($lectura->rowCount() > 0) {
            while ($fila = $lectura->fetchObject())
            $datos[] = $fila;
            return $datos;
        }
            else return null;

    } catch(PDOException $e){
        echo 'Excepción capturada: ' . $e->getMessage() . "\n";
    }
}

/**
 * Función get_datos_autor devuelve un objeto con los datos del autor cuyo id se ha entrado en parametros asi que los libros escrito por él.
 * @param mixed $id
 * @return stdClass
 */
function get_datos_autor($id){
    try {
        $info_autor = new stdClass();
        
        $sql = "SELECT * FROM autor where id='$id'";
        $lectura = conexion()->query($sql);
        $info_autor->datos = $lectura->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM libro where id_autor='$id'";
        $lectura = conexion()->query($sql);
        $info_autor->libros = $lectura->fetchAll();

    } catch(PDOException $e){
        echo 'Excepción capturada: ' . $e->getMessage() . "\n";
    }
    return $info_autor;
}

/**
 * Función get_datos_libro devuelve un objeto que contiene los detalles del libro cuyo id se ha entrado en parametros
 * @param mixed $id
 * @return stdClass
 */
function get_datos_libro($id){
    try {
        $info_libro = new stdClass();
        
        $sql = "SELECT l.titulo, DATE_FORMAT(l.f_publicacion, '%d/%m/%Y') AS f_publicacion, a.nombre, a.apellidos, a.id FROM Libro l INNER JOIN Autor a ON l.id_autor = a.id WHERE l.id='$id';";

        $lectura = conexion()->query($sql);
        $info_libro->datos = $lectura->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e){
        echo 'Excepción capturada: ' . $e->getMessage() . "\n";
    }
    return $info_libro;
}

/**
 * Función get_listado_libros devuelve la lista de los libros de la BDD
 * @return array|null
 */
function get_listado_libros(){
    try {
        $sql = "SELECT * FROM Libro";
        $lectura = conexion()->query($sql);
    
        if ($lectura->rowCount() > 0) {
            while ($fila = $lectura->fetchObject())
            $datos[] = $fila;
            return $datos;
        }
            else return null;
    
    } catch(PDOException $e){
        echo 'Excepción capturada: ' . $e->getMessage() . "\n";
    }   
} 

$posibles_URL = array("get_listado_autores", "get_datos_autor", "get_listado_libros", "get_datos_libro");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"]) {
    case "get_listado_autores":
        $valor = get_listado_autores();
        break;
    case "get_listado_libros":
        $valor = get_listado_libros();
        break;
    case "get_datos_autor":
        if (isset($_GET["id"]))
        $valor = get_datos_autor($_GET["id"]);
        else
        $valor = "Argumento no encontrado";
        break;
    case "get_datos_libro":
        if (isset($_GET["id"]))
        $valor = get_datos_libro($_GET["id"]);
        else
        $valor = "Argumento no encontrado";
        break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
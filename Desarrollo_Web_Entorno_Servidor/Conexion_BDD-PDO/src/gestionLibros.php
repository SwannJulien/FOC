<?php

require_once '../vendor/autoload.php';

/**
 * Gestionar la base de datos Libro: conectacr, consultar, borrar datos
 */
class gestionLibros
{
    /**
     * Conectarse a la base de datos a través de PDO
     * @param string $servidor Nombre del servidor
     * @param string $usuario Nombre del usuario de la bdd
     * @param string $contraseña Contraseña de acceso a la bdd
     * @param string $bd Nombre de la bdd
     * @return PDO|null Conexion con PDO OR null si error
     */
    public function conexion($servidor, $usuario, $contraseña, $bd)
    {
        try {
            //Conexión PDO
            $cadenaConexion = "mysql:dbname=$bd;host=$servidor";
            $pdo = new PDO(
                $cadenaConexion,
                $usuario,
                $contraseña,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            return $pdo;

        } catch (PDOException $e) {

            echo 'Fallo en la conexion';
            return null;
        }
    }

    /**
     * Consultar los libros de la bdd según el id del autor
     * @param object $pdo Objeto de conexion a la bdd
     * @param int $id id del autor
     * @return array|null Devuelve un array con el resultado de la consulta OR null
     */
    public function consultarLibros($pdo, $id)
    {
        try {
            if ($id != "") {
                $sql = "SELECT id, titulo, DATE_FORMAT(f_publicacion, '%d/%m/%Y') AS f_publicacion, id_autor FROM Libro where id_autor='$id';";
            }
            else{
                $sql = "SELECT id, titulo, DATE_FORMAT(f_publicacion, '%d/%m/%Y') AS f_publicacion, id_autor FROM Libro;";
            } 
                $resultado = $pdo->query($sql);
    
                if ($resultado->rowCount() > 0) {
                    while ($fila = $resultado->fetchObject())
                        $datos[] = $fila;
                    return $datos;
                } else
                    return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Consultar autores según su id
     * @param object $pdo  Objeto de conexion a la bdd
     * @param int $id id del autor
     * @return array|null Devuelve un array con el resultado de la consulta OR null
     */
    public function consultarAutores($pdo, $id)
    {
        try {
            if ($id != "") {
                $sql = "SELECT * FROM Autor WHERE id='$id';";
            }
            else{
                $sql = "SELECT * FROM Autor;";
            } 
            $resultado = $pdo->query($sql);
            
            if ($resultado->rowCount() > 0)
            {
            while ($fila = $resultado->fetchObject())
            $datos[] = $fila;
            return $datos;
            }
            else return null;
        } 
        catch (PDOException $e) {
            return null;
        }    
    }

    /**
     * Consultar los libros cuyo autor tiene el id entrado como parámetro
     * @param object $pdo Objeto de conexion a la bdd
     * @param int $id id del autor
     * @return array|null Devuelve un array con el resultado de la consulta OR null
     */
    public function consultarDatosLibro($pdo, $id)
    {
        try {
            if ($id != "") {
                $sql = "SELECT id, titulo, DATE_FORMAT(f_publicacion, '%d/%m/%Y') AS f_publicacion, id_autor FROM Libro where id='$id';";
            }
            else{
                $sql = "SELECT * FROM Libro;";
            } 
            $resultado = $pdo->query($sql);
            
            if ($resultado->rowCount() > 0)
            {
            while ($fila = $resultado->fetchObject())
            $datos[] = $fila;
            return $datos;
            }
            else return null;
        } 
        catch (PDOException $e) {
            return null;
        }    
    } 

    /**
     * Consultar el autores y los libros que haya escrito basandose con su id 
     * @param object $pdo Objeto de conexion a la bdd
     * @param int $id id del autor
     * @return array|null Devuelve un array con el resultado de la consulta OR null
     */
    public function libroPorAutor($pdo, $id)
    {
        try {
            if ($id != "") {
                $sql = "SELECT a.nombre, a.apellidos, a.nacionalidad, l.titulo, DATE_FORMAT(l.f_publicacion, '%d/%m/%Y') AS f_publicacion FROM Autor a INNER JOIN Libro l ON a.id = l.id_autor WHERE a.id = '$id';";
            }
            else{
                $sql = "SELECT a.nombre, a.apellidos, a.nacionalidad, l.titulo, DATE_FORMAT(l.f_publicacion, '%d/%m/%Y') AS f_publicacion FROM Autor a INNER JOIN Libro l ON a.id = l.id_autor;";
            } 
                $resultado = $pdo->query($sql);
    
                if ($resultado->rowCount() > 0) {
                    while ($fila = $resultado->fetchObject())
                        $datos[] = $fila;
                    return $datos;
                } else
                    return null;
        } catch (PDOException $e) {
            return null;
        }   
    }
    
    /**
     * Borrar un libro según su id
     * @param object $pdo Objeto de conexion a la bdd
     * @param int $id id del libro
     * @return bool Devuelve true si se ha borrado un registro OR false en caso contrario
     */
    public function borrarLibro($pdo, $id)
    {
        $sql = "DELETE FROM Libro WHERE id = '$id';";
        $resultado = $pdo->query($sql);

        if ($resultado->rowCount() == 0){
				echo "No se ha borrado ningún registro";
                return false;
            }
			else {
                $count = $resultado->rowCount();
                if ($count > 1)
                echo 'Se han borrado ' . $count . ' registros';
                else echo 'Se ha borrado ' . $count . ' registro';

                return true;
            }
    }

    /**
     * Borrar un autor según su id
     * @param object $pdo Objeto de conexion a la bdd
     * @param int $id id del autor
     * @return bool Devuelve true si se ha borrado un registro OR false en caso contrario
     */
    public function borrarAutor($pdo, $id)
    {
        $sql = "DELETE FROM Autor WHERE id = '$id';";
        $resultado = $pdo->query($sql);

        if ($resultado->rowCount() == 0){
				echo "No se ha borrado ningún registro";
                return false;
            }
			else { 
				$count = $resultado->rowCount();
                if ($count > 1)
				echo 'Se han borrado ' . $count . ' registros';
                else echo 'Se ha borrado ' . $count . ' registro';
                return true;
            }
    }
}

?>

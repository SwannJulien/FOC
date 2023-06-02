<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>API DWES</title>
 <body>
    <div class="wrapper">
        <img class="banner" src="../img/banner.png" alt="banner biblioteca">
        <h2>Bienvenidos a la biblioteca de FOC Granada</h2>
        <p> Pulse el botón <i>Consulta Autores</i> para ver un listado de los autores de la biblioteca.</p> 
        <p>Pulse el botón <i>Consulta Libros</i> para ver todos los libros de la biblioteca.</p>
        <form action="" method="get">
            <input type="submit" name="consulta_autores" value="Consulta Autores" class="btn btn__autores">
            <input type="submit" name="consulta_libros" value="Consulta Libros" class="btn btn__libros">
            <input type="submit" name="reset" value="Reset" class="btn btn__reset">
        </form>
<?php
if (isset($_GET['reset'])) {
    header("Location: http://localhost/dwes/07/local/src/cliente.php");
}

?>

<!-- Button consulta autores -->
<?php
    if (isset($_GET['consulta_autores'])) {
        $lista_autores = file_get_contents('http://localhost/dwes/07/local/src/api.php?action=get_listado_autores');
        // Convertimos el fichero JSON en array
        $lista_autores = json_decode($lista_autores);  
?>

<!-- Tabla de autores -->
<div class="center">    
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Acción</th>
            </tr>
<?php foreach($lista_autores as $autores): ?>
            <tr>
                <td><?=$autores->nombre?></td>
                <td><?=$autores->apellidos?></td>
                <td><a href="<?php echo "http://localhost/dwes/07/local/src/cliente.php?action=get_datos_autor&id=" . $autores->id  ?>">Detalles</a></td>
            </tr>
<?php endforeach; ?>
        </table>
</div>
<?php 
    } 
?>

<!-- Detalles del autor -->
<?php
// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") 
{
    //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
    $app_info = file_get_contents('http://localhost/dwes/07/local/src/api.php?action=get_datos_autor&id=' . $_GET["id"]);
    // Se decodifica el fichero JSON y se convierte a array
    $app_info = json_decode($app_info);
?>  
<div class="center">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nacionalidad</th>
                <th>Libro</th>
            </tr>
    <!-- Mostramos los libros del autor -->
    <?php foreach($app_info->libros as $libro): ?>
        <tr>
            <td><?=$app_info->datos->nombre?></td>
            <td><?=$app_info->datos->apellidos?></td>
            <td><?=$app_info->datos->nacionalidad?></td>
            <td><a href="<?php echo "http://localhost/dwes/07/local/src/cliente.php?action=get_datos_libro&id=" . $libro->id?>"><?=$libro->titulo?></a></td>
        </tr>
    <?php endforeach; ?>
        </table>
</div>
<?php
    }
?>

<!-- Consulta libros -->
<?php
    if (isset($_GET['consulta_libros'])) {
        $lista_libros = file_get_contents('http://localhost/dwes/07/local/src/api.php?action=get_listado_libros');
       
        // Convertimos el fichero JSON en array
        $lista_libros = json_decode($lista_libros);  
?>
<div class="center">
        <table>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Acción</th>
            </tr>
    
<?php foreach($lista_libros as $libros): ?>
            <tr>
                <td><?=$libros->id?></td>
                <td><?=$libros->titulo?></td>
                <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
            <td><a href="<?php echo "http://localhost/dwes/07/local/src/cliente.php?action=get_datos_libro&id=" . $libros->id  ?>">Detalles</a></td>
            </tr>
<?php endforeach; ?>
        </table>
</div>
<?php 
    } 
?>

<?php
// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") 
{
    //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
    $app_info = file_get_contents('http://localhost/dwes/07/local/src/api.php?action=get_datos_libro&id=' . $_GET["id"]);
    //var_dump($app_info);
    // Se decodifica el fichero JSON y se convierte a array
    $app_info = json_decode($app_info);
?>
<div class="center">  
        <table>
            <tr>
                <th>Titulo</th>
                <th>Fecha publicacion</th>
                <th>Nombre</th>
                <th>Apellidos</th>
            </tr>
        <!-- Mostramos los libros del autor -->
            <tr>
                <td><?=$app_info->datos->titulo?></td>
                <td><?=$app_info->datos->f_publicacion?></td>
                <td><?=$app_info->datos->nombre?></td>
                <td><a href="<?php echo "http://localhost/dwes/07/local/src/cliente.php?action=get_datos_autor&id=" . $app_info->datos->id?>"><?=$app_info->datos->apellidos?></a></td>
            </tr>
        </table>
</div>
<?php
    }
?>
    </div>    
</body>
</html>
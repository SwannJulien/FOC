<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{margin: 0 20px;}
    </style>
</head>
<body>
    <h1>Conexión a BDD con PDO</h1>
    <h3>Opciones:</h3>
    <ul>
        <li>Marque 0 para ver los libros de J.R.R Tolkien</li>
        <li>Marque 1 para ver los libros de Isaac Asimov</li>
        <li>Envie el formulario en vacío para ver todos los libros de ambos autores</li>
    </ul>

   <?php
    // Crear nueva instancia de la clase gestionLibro
        require_once("gestionLibros.php");
        $gestionLibros = new gestionLibros();   
   ?> 
   
   <form action="" method="post">
    <input type="text" name="id_autor">
    <input type="submit" name="submit" value="Enviar">
   </form>
   <br>

   <?php
   // Comprobar que se ha enviado el formulario 
    if (isset($_POST['submit'])) {
        // Cargar id_autor si está definido
        if(isset($_POST['id_autor'])) $id_autor = $_POST['id_autor'];
        else $id_autor = "";

        // Conectar a la bdd y Lanzar la consulta libroPorAutor
        $conexion = $gestionLibros->conexion('localhost', 'root', 'root', 'Libro');
        $consultarLibros = $gestionLibros->libroPorAutor($conexion, $id_autor);

        // Crear tabla con resultados de la consulta
        echo '<table>';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Nacionalidad</th>';
        echo '<th>Titulo</th>';
        echo '<th>Fecha publicación</th>';
        echo '</tr>';

        foreach ( $consultarLibros as $fila){
               //Procesar result set como objeto
            echo "<tr>";
            echo "<td>" . $fila->nombre . "</td>"
               . "<td>" . $fila->apellidos . "</td>"
               . "<td>" . $fila->nacionalidad . "</td>"
               . "<td>" . $fila->titulo . "</td>"
               . "<td>" . $fila->f_publicacion . "</td>";				
		    echo "</tr>";
        }
        echo '</tr>';
        echo '</table>';
    }
    else {
       $consultarLibros = [];
    }
   ?>

</body>
</html>
<?php

//Requerimos el archivo siguiente y llamamos a la función comprobarSesion()
require "funciones.php";
comprobarSesion();

    if(isset($_POST["grabar"]))
    {
        //Comprobamos que los campos telefono y email están seteados
        if(isset($_POST["telefono"])) $telefono = $_POST["telefono"];
        else $telefono = "";

        if(isset($_POST["email"])) $email = $_POST["email"];  
        else $email = "";

        //Si los campos no están vacio, se crean las variables de sesiones correspondientes
        if($telefono != "" && $email != "")
        {
            $_SESSION["telefono"] = $telefono;
            $_SESSION["email"] = $email;
        }

        //Mensaje de error en caso de campos vacios 
        else echo "<p class='alert'>Tiene que entrar un email y un número de telefono</p>";
    }

    //Si no se pulsa el botón grabar pero las variables de sesión telefono y email están seteados, se cargan las variables locales con los datos de las variables de sesión = la sesión ya está creada 
    else if(isset($_SESSION["telefono"]) && isset($_SESSION["email"]))
    {
        $telefono = $_SESSION["telefono"];
        $email = $_SESSION["email"];
    }
    else 
    {
        $telefono = "";
        $email = "";
    }
?>

<?php 
    /* Creación de la cookie "horario":
        1.  Comprobamos que el campo "horario" está seteado.
        2.  Si "horario" es diferente del campo "selección" y si no está vacio entonces se crea la cookie con el valor de la variable "horario".
        3.  Si la cookie está ya creada, se carga la variable local "horario" con el valor de la cookie. Asi se puede cargar directamente el valor de la cookie en el campo "horario". 
    */
    $cookie_name = "horario";
    if(isset($_POST["grabar"]))
    {
        if(isset($_POST["horario"])) $horario= $_POST["horario"];
        else $horario = "";

        if($horario != "selección" && $horario != "") 
        {
            $cookie_value = $horario;
            setcookie($cookie_name, $cookie_value, time()+(86400 * 30));
        }
        else echo "<p class='alert'>Tiene que seleccionar un horario</p>";
    }
    else if(isset($_COOKIE[$cookie_name])) $horario = $_COOKIE[$cookie_name];
    else $horario = "";  
?>

<?php 
    if(isset($_POST["borrar"])) eliminarSesion(); //eliminarSesion() borra la sesion y la cookie por completo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sesion</title>
</head>
<body>
    <form method="POST" action="?">
        <fieldset>
            <legend>Datos del usuario</legend>

            <div class="container">
                <label for="telefono">Telefono</label>
                <input type="tel" name="telefono" value="<?=$telefono?>" required>
            </div>

            <div class="container">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?=$email?>" required>
            </div>

            <div class="container">
                <label for="horario">Horario</label>
                <select class="dropdown" name="horario" id="horario">
                    <option value="selección" >--- Elija una de las opciones siguiente ---</option>
                    <option value="mañana" <?php if($horario == 'mañana') echo 'selected'?>>Mañana</option>
                    <option value="tarde" <?php if($horario == 'tarde') echo 'selected'?>>Tarde</option>
                    <option value="noche" <?php if($horario == 'noche') echo 'selected'?>>Noche</option>
                </select>
            </div>

            <div class="container flex-inline">
                <input class="btn btn-sesion" type="submit" name="grabar" value="Grabar">
                <input class="btn btn-sesion" type="submit" name="borrar" value="Borrar">
            </div>
        </fieldset>
    </form>
</body>
</html>
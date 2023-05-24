<?php 
    // Inicializamos session
    session_start();

    if(isset($_POST["enviar"]))
    {   
        //Encriptamos la contraseña
        $pass=crypt('Fdwes!22','$whatever');

        //Comprobamos que el usuario y la contraseña están inicializado
        if(isset($_POST["usuario"])) $usuario = $_POST["usuario"];
        else $usuario = "";

        if(isset($_POST["contraseña"])) $contraseña= $_POST["contraseña"];
        else $contraseña = "";

        //Comprobamos que el usuario y la contraseña no esten vacios
        if($usuario != "" && $contraseña != "")
        { 
            //Comprobamos la credencias
            if($usuario == "foc" && crypt($contraseña, '$whatever' ) == $pass )
            {
                //Si las credencias son corretas, se define la variable global $_SESSION["usuario] y nos redirige a la pagina web sesion.php
                $_SESSION["usuario"] = $usuario;
                header("Location: sesion.php");
            }
            //Credencias incorrectas = mensaje de error
            else echo "<p class='alert'>Credenciales incorrectas</p>"; 
        }
        //Usuario y contraseña vacios = mensaje de error
        else echo "<p class='alert'>Ambos campos son obligatorios</p>"; 
    }
    else if (isset($_SESSION["usuario"])) 
    {
        //Session ya inicializada
        $usuario = $_SESSION["usuario"];
    }
    //Por defecto, $usuario se carga en vacío 
    else $usuario = "";     
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="?">
            <fieldset>
                <legend>Login</legend>

                <div class="container">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" required value="<?=$usuario?>">
                </div>

                <div class="container">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña" required>
                </div>

                <div class="container">
                    <input class="btn" type="submit" name="enviar" value="Enviar">
                </div>
            </fieldset>
        </form>
    </body>
</html>

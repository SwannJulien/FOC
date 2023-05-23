<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>DWES T3</title>  
        <style>
            /* table {border: solid black 2px; margin-top: 10px;}
            td {border: solid black 1px; padding: 5px; text-align: center;} */
        </style>
<?php
// Comprobación que existen las entradas "enviar" y "valor" e inicialisación de la variable $valor
    if (isset($_POST["enviar"])) {
        if (isset($_POST["valor"])) $valor = $_POST["valor"];
        else $valor = "";     
    }
    else {
        $valor = ""; 
    }     
?>   
    </head>
    <body>
        <h1>Tarea 3 - Programación básica</h1>
        <br>
        <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
            <fieldset>
                <legend>Cuenta atrás de 3 en 3</legend>
                <label for="valor">Introduzca un número entero entre 0 y 10</label>
                <input class="input_box" type="text" id="valor" name="valor" value="<?=$valor?>">
                <input class="btn" type="submit" value="Enviar" name="enviar">
            </fieldset>
        </form>
<?php
// Comprobación de las condiciones de validación del formulario
if (isset($_POST["valor"])){
    if ($valor != "")
        switch(true){
            case (!is_numeric($valor)): 
                echo "<h2>Introduzca un valor numérico</h2>";
                break;
            case ($valor < 0);
                echo "<h2>Introduzca un valor positivo</h2>";
                break;
            case ($valor >= 0 && $valor <= 10);
                $valores = generarArray($valor);
                echo tabla($valores);
                break;
            case ($valor > 10);
                echo "<h2>Número demasiado grande</h2>";
                break;
            default:
                echo "<h2>Valor desconocido</h2>";
                break;
        }
    else echo "<h2>Introduzca un valor</h2>";
} 

// Función generarArray() resta de 3 por 3 el parametro de entrada hasta llegar a 0 y devuleve un array compuesto de los resultados de cada iteración 
    function generarArray($valor){
        $numero = array($valor);
                
        while (($valor - 3) >= 0){
        $valor = $valor -3;
        $numero[] = $valor;
        } 
        return $numero;
    }  

// Función tabla() crea una tabla html a partir de un array como parametro de entrada, cada entrada del array estando en una celda diferente
    function tabla($array){
        echo "<table>"; 
        echo "<tr>";

        for ($i = 0; $i <count($array); $i++){ 
        echo "<td>" . "$array[$i]" . "</td>";
        }

        echo "</tr>";
        echo "</table>";
    }

    // echo tabla($valores);
    ?>
        
    </body>
</html>

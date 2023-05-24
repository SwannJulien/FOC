<?php 
/**
 * @author Swann Julien <swann.jn@gmail.com>
 * @date 27/12/2022
 * @title Plantilla base de la aplicación creada con PHP Template Inheritance
 * 
 * Impide acceder a la BD sin pasar previamente por el controlador
 */
    if(!defined('CON_CONTROLADOR'))
    {
        echo "No se puede acceder a este fichero directamente";
        die();
    }
?>

<?php include 'ti.php'?>

<html>
    <head>
        <link rel="stylesheet" href="/DWES/T5/style.css">
    </head>
    <body>
        <header>
            <nav>
                <ul class="flex-right">
                    <li><a href="/DWES/T5/index.php">Inicio</a></li>
                    <li><a href="/DWES/T5/index.php/resenia">Reseñas</a></li>
                    <li><a href="/DWES/T5/index.php/registro">Registro</a></li>
                </ul>
            </nav>
        </header>
        <div class="center">
            <img class="banner" src="/DWES/T5/img/banner-home.png">   
        </div>
        <div class="page-wrap">
            <main>
                <?php startblock('main');?> <?php endblock()?>
            </main>
        </div>
        <footer>
            <h3 class="m-0">Swann Julien</h3>
            <p>DWES Tarea 5 - FP DAW FOC 2022</p>
        </footer>
    </body>
</html>




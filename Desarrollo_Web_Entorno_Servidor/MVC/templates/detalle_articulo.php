<?php include 'base.php'?>

<?php startblock('main')?>

<div class="flex gap-80 maring-tb-100">
    <div class="left-column">
        <img src="<?= "/DWES/T5/img/" . $articulo['a_imagen']?>">
    </div>
    <div class="right-column">
        <h2><?= $articulo['titulo']?></h2>
        <p class="product__description"><?= $articulo['descripcion']?></p>
        <p class="product__price"><?= $articulo['precio']?></p>
        <a class="review-link"href="/DWES/T5/index.php/resenia">Ver reseñas</a>
    </div>
</div>
<?php endblock() ?>
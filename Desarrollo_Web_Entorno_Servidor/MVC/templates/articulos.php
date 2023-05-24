<?php include 'base.php'?>

<?php startblock('main')?>
    <ul class="flex wrap gap-20 maring-tb-100">
        <?php foreach ($articulos as $articulo): ?>
            <li class="list-product">
                <div class="center">
                    <img class="product__img" src="<?= "img/".$articulo['a_imagen']?>">
                    <h2><?= $articulo['titulo']?></h2>
                    <p class="product__price"><?= $articulo['precio']?></p>
                    <button class="btn btn-product">
                        <a class="link" href="/DWES/T5/index.php/articulo?id=<?= $articulo['id']?>">COMPRAR</a>
                    </button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endblock() ?>
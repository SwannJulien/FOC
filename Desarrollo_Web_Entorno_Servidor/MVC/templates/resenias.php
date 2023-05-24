<?php include 'base.php'?>

<?php startblock('main')?>
    <form action="" method="GET">
        <?php foreach ($resenias as $resenia): ?>    
                <div class="review">
                    <div class="flex review-flex">
                        <img class="review__picture" src="<?= '/DWES/T5/img/' . $resenia['foto']?>"</img>
                        <div class="user-flex">
                            <p class="review__user"><?= $resenia['usuario'] . ' ' ?></p>
                            <p class="review__score"><?= "Estrellas: " . $resenia['estrella']?></p>
                            <p class="review__review"><?= $resenia['resenia'] . ' '?></p>
                        </div>
                    </div>
                </div>
                <div class="feedback">
                <?php foreach ($formulario as $campo): ?>
                    <p><?= $campo[0]?></p>
                    <input type="<?= $campo[1]?>" name="<?=$campo[2]?>" value="<?=$campo[3]?>"> 
                <?php endforeach; ?>
                </div> 
        <?php endforeach; ?>
    </form>
<?php endblock()?>


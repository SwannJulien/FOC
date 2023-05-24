<?php include 'base.php'?>

<?php startblock('main')?>
	<form action="" method="post">
		<?php foreach($formulario as $campo): ?>
			<p class="label"><?= $campo[0]?></p>
            <input type="<?= $campo[1]?>" name="<?=$campo[2]?>" value="<?=$campo[3]?>"> 			
        <?php endforeach; ?>
        <?php 
            if (isset($alert)) echo '<p class="alert">' . $alert . '</p>';
            else $alert = '';
        ?>
		
	</form>
<?php endblock()?>

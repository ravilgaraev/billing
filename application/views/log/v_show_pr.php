<?php for($i=0; $i< count($data);$i++):?>
    <?php for($y=0; $y< count($data[$i]);$y++): ?>
        <?php echo $data[$i][$y];?>
    <?php endfor ?>
    <?php echo "<br>";?>
<?php endfor; ?>
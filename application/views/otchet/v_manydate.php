<?php $i=1; $date = ""; $itogo = 0;?>
<div class="row">

    <div class="col-lg-8">
        <table class="table">
            <?php foreach ($manydate as $key => $value):?>
                <?php if($date != $value['date'])
                {
                    $date = $value['date'];
                    echo "<tr><td></td></tr>";
                }
                ; ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $value['user'];?></td>
                <td><?php echo $value['date'];?></td>
                <td><?php echo $value['sum']; $itogo +=$value['sum']; ?></td>
                <td><?php echo $value['cmt'];?></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php echo "Итого ",$itogo; ?>
    </div>
</div>
<div class="row">
<!--    <div class="col-lg-4">
        <span>Итого: </span> <?php //echo $sumschet;?>
    </div>-->
</div>
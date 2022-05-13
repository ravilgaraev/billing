<?php $sumschet = 0; $sumvnesen = 0; $i=1; ?>
<div class="row">
    <div class="col-lg-8">
        <table class="table table-striped table-bordered">
            <tr class="text-center">
                <td>№</td>
                <td>Имя</td>
                <td>Дата</td>
                <td>Сумма</td>
                <td>За што?</td>
            </tr>
            <?php foreach ($many as $key => $value):?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $value['user'];?></td>
                <td><?php $date = substr($value['date'],6,2)."-".substr($value['date'],4,2)."-".substr($value['date'],0,4);
                echo $date; ?></td>
                <td><?php echo number_format($value['sum'],2,'.',','); $sumvnesen += $value['sum'];?></td>
                <td><?php echo $value['cmt'];?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td>Итого:</td>
                <td colspan="2"></td>
                <td><?php echo number_format($sumvnesen,2,'.',',');?></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
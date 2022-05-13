<?php $itogo = 0;?>
<table class="table table-bordered table_info">
    <tr>
        <td style="width: 50%">Коментарии</td>
        <td>Единица</td>
        <td>Количество</td>
        <td>Цена</td>
        <td>Стоимость поставки</td>
        <td>Ставка НДС	</td>
        <td>Сумма НДС</td>
        <td>Сумма</td>
    </tr>
<?php if('n' == $user['nds']) {$stavkands = 0;} else {$stavkands = $user['stavkands'];} ?>
<?php foreach ($services as $key => $value) :?>
    <tr>
        <td style="width: 50%"><?php echo $value['service'];?></td>
        <td class="text-right"><?php echo $value['unit'];?></td>
        <td class="text-right"><?php echo $value['amount'];?></td>
        <td class="text-right">
            <?php
                //if(0 != $value['skidka']) {$value['price']*=$value['skidka'];};
                echo number_format($value['price']*100/($stavkands+100),2,'.',',');
            ?>
        </td>
        <td class="text-right">
            <?php
                //if(0 != $value['skidka']) {$value['price']*=$value['skidka'];};
                echo number_format($value['amount']*$value['price']*100/($stavkands+100),2,'.',',');
            ?>
        </td>
        <td class="text-right">
            <?php echo ('n' == $user['nds'])?"Без НДС":$stavkands.'%';
//                if(0 == $value['price'])
//                {
//                    echo "0";
//                }
//                else
//                {
//                    echo $stavkands,"%";
//                }
            ?>
        </td>
        <td class="text-right"><?php echo number_format($value['amount']*$value['price'] - $value['amount']*$value['price']*100/($stavkands+100),2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($value['total'],2,'.',',');?></td>
    </tr>
    <?php $itogo += $value['total'];?>
<?php endforeach;?>
    <tr>
        <td>Итого</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><?php echo number_format($itogo,2,'.',','); ?></td>
    </tr>    
</table>
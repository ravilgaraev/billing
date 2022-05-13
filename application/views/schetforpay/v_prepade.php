<?php $itog1 = 0;$itog2 = 0;$itog3 = 0;$i = 1; ?>
<table class="table table-border">
    <tr>
        <td>№</td>
        <td>Абонент</td>
        <td>Состояние счета</td>
        <td>Текущий месяц</td>
        <td>К оплате</td>
    </tr>
    
    <?php foreach ($users as $key => $value):?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td>
                <?php echo $value['username'];?>
            </td>
            <td>
                <?php echo number_format($value['sum']-$value['prise']-$value['prise_one'],2,'.',',');
                $itog3 +=$value['sum']-$value['prise']-$value['prise_one'];?>
            </td>
            <td>
                <?php echo number_format($value['prise']+$value['prise_one'],2,'.',',');
                    $itog1 +=$value['prise']+$value['prise_one'];?>
            </td>
            <td>
                <?php
                    if(0 == $value['sum']-$value['prise']-$value['prise_one']){
                        echo number_format($value['prise'],2,'.',',');
                        $itog2 +=$value['prise'];
                    }
                    else
                    {
                        echo number_format($value['sum']*-1 + $value['prise'] + $value['prise_one']+$value['prise'],2,'.',',');
                        $itog2 +=($value['sum']*-1 + $value['prise'] + $value['prise_one']+$value['prise']);
                    }
                   
                ?>
            </td>
        </tr>
    <?php endforeach;?>
        <tr>
            <td>Итого:</td>
            <td></td>
            <td>
                <?php echo number_format($itog3,2,'.',',');?>
            </td>
            <td>
                <?php echo number_format($itog1,2,'.',',');?>
            </td>
            <td>
                <?php echo number_format($itog2,2,'.',',');?>
            </td>
        </tr>
</table>
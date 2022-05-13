<?php $itog1 =0; $itog2 = 0;?>
<table class="table table-border">
    <tr>
        <td>Абонент</td>
        <td>Организация</td>
        <td>Предедущие периоды</td>
        <td>Текущий месяц</td>
        <td>Трафик</td>
    </tr>
    <?php foreach ($users as $key => $value):?>
        <tr>
            <td>
                <?php echo $value['username'];?>
            </td>
            <td>
                <?php echo $value['orgr'];?>
            </td>
            <td>
                <?php 
                   echo number_format($value['befo'],2,'.',',');
                ?>
            </td>
            <td>
                <?php 
                   $itog1 +=$value['sum'];
                   echo number_format($value['sum'],2,'.',',');
                ?>
            </td>
            <td>
                <?php 
//                   $itog2 +=$itog1-$value['prise'];
//                   echo number_format($itog1-$itog2,2,'.',',');
                    echo $value['tr'];
                ?>
            </td>
        </tr>
    <?php endforeach;?>
        <tr>
            <td>Итого:</td><td></td><td></td>
            <td>
                <?php echo number_format($itog1,2,'.',',');?>
            </td>
            <td>
                <?php echo number_format($itog2,2,'.',',');?>
            </td>
        </tr>
</table>
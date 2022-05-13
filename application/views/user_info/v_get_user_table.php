<table class="table table-bordered table_info">
    <tr class="text-right">
        <td class="text-left" style="width: 50%">Услуги</td>
        <td>Единица</td>
        <td>Количество</td>
        <td>Цена</td>
        <td>Сумма</td>
    </tr>
<?php if('Y' == $user[0]['unlim']): ?>
    <tr>    
        <td><?php echo $user[0]['coment']; ?></td>
        <td class="text-right">месяц</td>
        <td class="text-right"><?php echo $user[0]['skidka']; ?></td>
        <td class="text-right">
            <?php 
                echo number_format($user[0]['prise'],2,'.',',');
            ?>
        </td>
        <td class="text-right"><?php 
            echo number_format($user[0]['skidka'] * $user[0]['prise'],2,'.',',');
            ?>
        </td>
    </tr>
<?php endif; ?>
<?php if($user[0]['plan'] > 0 ): ?>
    <tr>
        <td><?php echo $user[0]['coment']; ?></td>
        <td class="text-right">Гб</td>
        <td class="text-right"><?php echo $user[0]['plan']/1073741824;?></td>
        <td class="text-right"><?php echo number_format($user[0]['prise'],2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($user[0]['prise'],2,'.',',');?></td>
    </tr>
<?php endif; ?>
<?php if($traffic_in > 0 ): ?>
    <tr>
        <td>Всего входящий трафик</td>
        <td class="text-right">Mbyte</td>
        <td class="text-right"><?php echo number_format(($traffic_in-$traffic_in_priv)/1048576,2,'.',',');?></td>
        <td class="text-right"></td>
        <td class="text-right"></td>
    </tr>
<?php endif; ?>
<?php if($traffic_out > 0 ): ?>
    <tr>
        <td>Всего исходящий трафик</td>
        <td class="text-right">Mbyte</td>
        <td class="text-right"><?php echo number_format(($traffic_out-$traffic_out_priv)/1048576,2,'.',',');?></td>
        <td class="text-right"></td>
        <td class="text-right"></td>
    </tr>
<?php endif; ?>
<?php if (isset($traffic_in_pr))
        {
            echo "<tr>";
            echo "<td>Превышение входящего трафика</td>";
            echo "<td>Mbyte</td>";
            echo "<td class=\"text-right\">",number_format($traffic_in_pr/1073741824,2,'.',','),"</td>";
            echo "<td class=\"text-right\">",$user1[0]['price_out'],"</td>";
            echo "<td class=\"text-right\">";
            if ($price_in_pr > $price_out_pr) {echo number_format($price_in_pr,2,'.',',');}
            echo "</td>";
            echo "</tr>";
        }
?>
<?php if (isset($traffic_out_pr))
        {
            echo "<tr>";
            echo "<td>Превышение изходящего трафика</td>";
            echo "<td>Mbyte</td>";
            echo "<td class=\"text-right\">",number_format($traffic_out_pr/1073741824,2,'.',','),"</td>";
            echo "<td class=\"text-right\">",$user1[0]['price_out'],"</td>";
            echo "<td class=\"text-right\">";
            if ($price_in_pr < $price_out_pr) {echo number_format($price_out_pr,2,'.',',');}
            echo "</td>";
            echo "</tr>";
        }
?>
<!-- Dialup -->
<?php if ('P' == $user[0]['unlim']):?>
<?php foreach ($traffic as $key):?>
    <tr>
        <td><?php echo $key['coment'];?></td>
        <td><?php echo $key['ed'];?></td>
        <td class="text-right">
            <?php if('' != $key['hours'])
                {
                    echo number_format($key['hours'],2,'.',',');
                }
                else
                {
                    echo $key['tr_in'],$key['tr_out'];
                }
            ?>
        </td>
        <td class="text-right">
            <?php if('' != $key['price'])
            {
                echo number_format($key['price'],2,'.',',');
            }?>
        </td>
        <td class="text-right">
            <?php if('' != $key['price'])
                {
                    echo number_format($key['price']*
                    number_format($key['hours'],2,'.',','),2,'.',',');
                }?>
        </td>
    </tr>
<?php endforeach;?>
<?php endif; ?>    
<!--Вывод услуг-->
<?php foreach ($services as $key):?>
    <tr>
        <td><?php echo $key['service'];?></td>
        <td class="text-right">месяц</td>
        <td class="text-right">1</td>
        <td class="text-right"><?php echo number_format($key['price'],2,'.',','); ?></td>
        <td class="text-right"><?php echo number_format($key['price'],2,'.',','); ?></td>
    </tr>
<?php endforeach;?>
<!-- Разовые услуги -->
<?php foreach ($one_time as $key):?>
    <tr>
        <td><?php echo $key['service'];?></td>
        <td class="text-right">месяц</td>
        <td class="text-right">1</td>
        <td class="text-right"><?php echo number_format($key['price'],2,'.',','); ?></td>
        <td class="text-right"><?php echo number_format($key['price'],2,'.',','); ?></td>
    </tr>
<?php endforeach;?>
    <tr>
        <td>Итого</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><?php echo number_format($itogo,2,'.',','); ?></td>
    </tr>    
</table>

<div class="text-primary">
    <div class="text-center">
        <h4>СОСТОЯНИЕ ЛИЦЕВОГО СЧЕТА АБОНЕНТА</h4>
    </div>
<?php 

$user1 = $user['u'];
$many = $user['m'];
$traffic = $user['t'];
$services = $user['s'];

$sum = 0;
foreach ($many as $key => $value)  {$sum += $value['sum'];}//остаток на счете

foreach ($services as $key) {$sum -= (int) $key['price'];}//сумма за услуги

$itogo = 0;
$traffic_in = 0;
$traffic_out =0;
$traffic_in_priv = 0;
$traffic_out_priv = 0;
$price_in_pr = 0;
$price_out_pr = 0;
// Считает трафик время
if("P" != $user1[0]['unlim'])
{
    foreach ($traffic as $key)//подсчет трафика
    {
        $traffic_in += $key['Bytes_out'];
        $traffic_in_priv += $key['Bytes_out_priv'];
        $traffic_out += $key['Bytes_in'];
        $traffic_out_priv += $key['Bytes_in_priv'];
    }
    
    //превышение трафика
    if (("N" == $user1[0]['unlim'])&&
            (($traffic_in-$traffic_in_priv) > $user1[0]['plan']))
        {
            $traffic_in_pr = $traffic_in-$traffic_in_priv - $user1[0]['plan'];
            $price_in_pr = $traffic_in_pr/1048576 * (int)$user1[0]['price_out'];
        }

    if (("N" == $user1[0]['unlim'])&&
            (($traffic_out-$traffic_out_priv) > $user1[0]['plan']))
        {
            $traffic_out_pr = ($traffic_out-$traffic_out_priv)-$user1[0]['plan'];
            $price_out_pr = $traffic_out_pr/1048576 * $user1[0]['price_out'];
        }
    if ($price_in_pr > $price_out_pr) {$itogo += $price_in_pr;}
            else {$itogo += $price_out_pr;}    
}
else
{
    foreach ($traffic as $key)
    {
        if('' != $key['hours'])
        {
            $itogo += number_format($key['price']*number_format($key['hours'],2,'.',','),2,'.',',');
        }
    }
}
$itogo += $user1[0]['prise'];

foreach ($user1 as $key) :?>
    <table class="table table-bordered table-striped">
    <tr> <td class="table_info_30"> Абонент: </td><td  class="table_info"><?php echo $key['orgr']  ;?> </td> </tr>
    <tr> <td class="table_info_30"> Имя пользователя: </td><td  class="table_info"><?php echo $key['username'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Номер контракта: </td><td  class="table_info"><?php echo $key['contract'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Дата заключения контракта: </td><td  class="table_info"><?php echo $key['cdate'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Адрес: </td><td  class="table_info"><?php echo $key['address_n'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Телефон: </td><td  class="table_info"><?php echo $key['phones'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Факс: </td><td  class="table_info"><?php echo $key['fax'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Контактное лицо: </td><td  class="table_info"><?php echo $key['contactperson'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Контактная почта: </td><td  class="table_info"><?php echo $key['postmaster'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Текущий статус: </td><td  class="table_info"><?php echo $key['status'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Адрес подключения: </td><td  class="table_info"><?php echo $key['addr_podkl'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> IP адрес: </td><td  class="table_info"><?php echo $key['ip_addr'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> АТС: </td><td  class="table_info"><?php echo $key['ats'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Порт: </td><td  class="table_info"><?php echo $key['port'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Оборудование: </td><td  class="table_info"><?php echo $key['oborudovanie'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Домены на хостинге: </td><td  class="table_info"><?php echo $key['webdomains'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Текущее состояние счета: </td><td  class="table_info"><?php echo number_format($sum - $itogo,2,'.',',') ;?> </td> </tr>
    </table>
<?php endforeach;?>
    
<?php 
foreach ($services as $key) //итоговая сумма услуг
{
    $itogo += $key['price'];
}
?>
<div class="row text-center">Статьи расхода за <?php echo date("m/Y");?></div>
<table class="table table-bordered table_info">
    <tr>
        <td style="width: 50%">Коментарии</td>
        <td>Единица</td>
        <td>Количество</td>
        <td>Цена</td>
        <td>Сумма</td>
    </tr>
<?php if('Y' == $user1[0]['unlim']): ?>
    <tr>    
        <td><?php echo $user1[0]['coment']; ?></td>
        <td>месяц</td>
        <td class="text-right">1</td>
        <td class="text-right"><?php echo number_format($user1[0]['prise'],2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($user1[0]['prise'],2,'.',',');?></td>
    </tr>
<?php endif; ?>
<?php if($user1[0]['plan'] > 0 ): ?>
    <tr>
        <td><?php echo $user1[0]['coment']; ?></td>
        <td>Гб</td>
        <td class="text-right"><?php echo $user1[0]['plan']/1073741824;?></td>
        <td class="text-right"><?php echo number_format($user1[0]['prise'],2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($user1[0]['prise'],2,'.',',');?></td>
    </tr>
<?php endif; ?>
<?php if($traffic_in > 0 ): ?>
    <tr>
        <td>Всего входящий трафик</td>
        <td>Mbyte</td>
        <td class="text-right"><?php echo number_format(($traffic_in-$traffic_in_priv)/1048576,2,'.',',');?></td>
        <td class="text-right"></td>
        <td class="text-right"></td>
    </tr>
<?php endif; ?>
<?php if($traffic_out > 0 ): ?>
    <tr>
        <td>Всего исходящий трафик</td>
        <td>Mbyte</td>
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
            echo "<td class=\"text-right\">",number_format($traffic_in_pr/1048576,2,'.',','),"</td>";
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
            echo "<td class=\"text-right\">",number_format($traffic_out_pr/1048576,2,'.',','),"</td>";
            echo "<td class=\"text-right\">",$user1[0]['price_out'],"</td>";
            echo "<td class=\"text-right\">";
            if ($price_in_pr < $price_out_pr) {echo number_format($price_out_pr,2,'.',',');}
            echo "</td>";
            echo "</tr>";
        }
?>
<!-- Dialup -->
<?php if ('P' == $user1[0]['unlim']):?>
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
        <td><?php echo $key['unit'];?><!--месяц--></td>
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
    
    
    
<table class="table table-bordered table-striped">
    <tr class="text-center">
        <td class="table_info">Дата</td>
        <td class="table_info">Приход</td>
        <td class="table_info">Расход</td>
        <td class="table_info">Остаток</td>
        <td class="table_info">Коментарии</td>
    </tr>
<?php $sum =0;?>
<?php foreach ($many as $key => $value):?>
    <tr>
        <td class="table_info">
            <?php echo Date::formatted_time($value['date'],"d.m.Y"); //date("B",$value['date']);?>
        </td>
        <?php if ($value['sum'] > 0) 
                {echo "<td class=\"table_info text-right\">",
                        number_format($value['sum'],2,'.',','),
                        "</td>", 
                        "<td class=\"table_info\"></td>";}
            else 
                {echo "<td class=\"table_info\"></td>",
                        "<td class=\"table_info text-left\">",
                        number_format($value['sum'],2,'.',','),
                        "</td>";};?>
        <td class="table_info"><?php echo number_format($sum+=$value['sum'],2,'.',',');?></td>
        <td class="table_info"><?php echo $value['cmt'];?></td>
    
    </tr>
<?php endforeach;?>
</table>
</div>
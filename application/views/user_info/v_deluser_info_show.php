<div class="text-primary">
    <div class="text-center">
        <h4>СОСТОЯНИЕ ЛИЦЕВОГО СЧЕТА АБОНЕНТА</h4>
    </div>
<?php 

$user1 = $user['u'];
$many = $user['m'];
?>
<?php foreach ($user1 as $key) :?>
    <table class="table table-bordered table-striped">
    <tr> <td class="table_info_30"> Абонент: </td><td  class="table_info"><?php echo $key['orgr']  ;?> </td> </tr>
    <tr> <td class="table_info_30"> Тип абонента: </td><td  class="table_info"><?php echo $key['urfiz']  ;?> </td> </tr>
    <tr> <td class="table_info_30"> Имя пользователя: </td><td  class="table_info"><?php echo $key['username'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Номер контракта: </td><td  class="table_info"><?php echo $key['contract'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Дата заключения контракта: </td><td  class="table_info">
            <?php $dd = explode('-',$key['cdate']); echo $dd[2].'/'.$dd[1].'/'.$dd[0]  ;?>
        </td>
    </tr>
    <tr> <td class="table_info_30"> Адрес: </td><td  class="table_info"><?php echo $key['address_n'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Телефон: </td><td  class="table_info"><?php echo $key['phones'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Факс: </td><td  class="table_info"><?php echo $key['fax'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Контактное лицо: </td><td  class="table_info"><?php echo $key['contactperson'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Паспортные данные: </td><td  class="table_info"><?php echo $key['passport'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Контактная почта: </td><td  class="table_info"><?php echo $key['postmaster'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Текущий статус: </td><td  class="table_info"><?php echo $key['status'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Адрес подключения: </td><td  class="table_info"><?php echo $key['addr_podkl'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> IP адрес: </td><td  class="table_info"><?php echo $key['ip_addr'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> АТС: </td><td  class="table_info"><?php echo $key['ats'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Порт: </td><td  class="table_info"><?php echo $key['port'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Оборудование: </td><td  class="table_info"><?php echo $key['oborudovanie'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Домены на хостинге: </td><td  class="table_info"><?php echo $key['webdomains'] ;?> </td> </tr>
    <tr> <td class="table_info_30"> Order ID: </td><td  class="table_info"><?php echo $key['orderid'] ;?> </td> </tr>
    </table>
<?php endforeach;?>

<br />
<row class="text-center"><div>Операции с лицевым счетом Абонента:</div></row>
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
<div class="col-md-4 text-right">
    <p>Директор _____________</p>
    <p>Главный бухгалтер _____________</p>
    <br />
    
</div>
<br /><br /><br /><br />
<div class="row">
    <div class="col-lg-4">
        <form target="blank" action="showdelsf" method="get">
            <input type="hidden" name="username" value="<?php echo $user1[0]['username'] ;?>" />
            <input type="submit" name="show" value="счет фактуры" class="btn btn-primary"/>            
        </form>
    </div>
    <div class="col-lg-4">
        <form action="getbackdeluser" method="get">
            <input type="hidden" name="username" value="<?php echo $user1[0]['username'] ;?>" />
            <input type="submit" name="getback" value="Востановить" class="btn btn-primary"/>            
        </form>
    </div>
    <div class="col-lg-4">
        <form action="delusernahren" method="get">
            <input type="hidden" name="username" value="<?php echo $user1[0]['username'] ;?>" />
            <input type="submit" name="getback" value="Удалить, совсем удалить" class="btn btn-primary"/>
        </form>
    </div>
</div>
<br /><br /><br />
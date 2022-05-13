<div class="text-primary">
    <div class="text-center">
        <h4>СОСТОЯНИЕ ЛИЦЕВОГО СЧЕТА АБОНЕНТА</h4>
    </div>
<?php 

$user1 = $user['user'];
$many = $user['many'];
$table = $user['table'];
$befo = $user['befo'];
$itogo = $user['itogo'];
$sum = $user['sum'];

?>
<div class="row">
<?php foreach ($user1 as $key) :?>
    <?php $username = $key['username']; ?>
        <div class="col-md-7">
            <table class="table table-bordered table-striped">
                <tr> <td class="table_info_30"> Абонент: </td><td  class="table_info"><?php echo $key['orgr']  ;?> </td> </tr>
                <tr> <td class="table_info_30"> Тип абонента: </td><td  class="table_info"><?php echo $key['urfiz']  ;?> </td> </tr>
                <tr> <td class="table_info_30"> Имя пользователя: </td><td  class="table_info"><?php echo $key['username'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Номер контракта: </td><td  class="table_info"><?php echo $key['contract'] ;?> </td> </tr>
                <!--<tr> <td class="table_info_30"> Регистрационный код НДС: </td><td  class="table_info"><?php //echo $key['rkpnds'] ;?> </td> </tr>-->
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
                <tr> <td class="table_info_30"> Порт (Международный VPN): </td><td  class="table_info"><?php echo $key['port'] ;?></td> </tr>
                <tr> <td class="table_info_30"> Скорость: </td><td  class="table_info"><?php echo $key['speed'] ;?></td> </tr>
                <tr> <td class="table_info_30"> Оборудование: </td><td  class="table_info"><?php echo $key['oborudovanie'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Домены на хостинге: </td><td  class="table_info"><?php echo $key['webdomains'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Order ID: </td><td  class="table_info"><?php echo $key['orderid'] ;?> </td> </tr>
                <tr> 
                    <td class="table_info_30">
                        <?php 
                            if(0<$sum - $itogo){echo 'Остаток на лицевом счету Абонента с учетом расходов в текущем месяце составляет';}
                            else {echo 'Задолженность на лицевом счету Абонента с учетом расходов в текущем месяце составляет';}
                        ?>
                    </td>
                    <td  class="table_info">
                        <?php 
                            if("Usd" == $key['paymentmethod']){$valuta=2;}else{$valuta=1;}
                            if("Euro" == $key['paymentmethod']){$valuta=3;}
                            $many_itogo = number_format($sum - $itogo,2,'.','');
                            echo number_format($sum - $itogo,2,'.',','), " (", Model::factory('sumpropis')->num2str($many_itogo,$valuta),")";
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered table-striped">
                <tr><td class="table_info_30">Номер счета:</td><td class="table_info_30"><?php echo $key['account_num'] ;?></td></tr>
                <tr><td class="table_info_30">Банк:</td><td class="table_info_30"><?php echo $key['bankdetails'] ;?></td></tr>
                <tr><td class="table_info_30">ИНН:</td><td class="table_info_30"><?php echo $key['inn'] ;?></td></tr>
                <tr><td class="table_info_30">МФО:</td><td class="table_info_30"><?php echo $key['mfo'] ;?></td></tr>
                <tr><td class="table_info_30">ОКЕД:</td><td class="table_info_30"><?php echo $key['oked'] ;?></td></tr>
                <tr><td class="table_info_30">Регистрационный код НДС:</td><td class="table_info_30"><?php echo $key['rkpnds'] ;?></td></tr>
                <tr><td class="table_info_30">SWIFT:</td><td class="table_info_30"><?php echo $key['swift'] ;?></td></tr>
            </table>
            <div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?php echo $username; ?>" />
                    <p>Выбрать файл:</p>
                    <p><input type="file" name="doc" /></p>
                    <p><input type="submit" name="submit" id="submit" value="Загрузить" class="btn btn-primary" /></p>
                </form>
                <table class="table table-bordered">
                    <?php foreach ($doc_file as $key => $value):?>
                        <tr>
                            <td><a href="<?php echo substr($value['file'],25);?>" ><?php echo $value['file_name'];?></a></td>
                            <?php if('admin' == Cookie::get('role')):?>
                                <td><a href="delupload?username=<?php echo $username; ?>&file=<?php echo $value['file']; ?>"
                                       onclick="return confirm('Удалить')">Удалить</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    <?php 
        $u = $key['username'];
        $o = $key['orgr'];
        $ph = $key['phones'];
        $p = $key['port'];
        $user = Cookie::get('user');
    ?>
<?php endforeach;?>
    
</div>
    
    <a href="http://ticket.bcc.uz/add?username=<?php echo $u."&orgr=".$o."&phone=".$ph."&port=".$p."&luser=".$user;?>"
        target="_blank" class="btn btn-primary"> Тикет 
    </a>
<div class="row text-center">Статьи расхода за <?php echo date("m/Y");?></div>
<?php 
    $month = date("m")-1;
    $year = date("Y");
    if(0 == $month){$month =12;$year -=1;}
    if(10>$month){$month ="0".$month;}
    echo $table;
    echo '<div class="row text-center">Расходы Абонента за ',$month,'/',$year,'</div>';
    echo $befo;
?>
<br>

<br />
<div><row class="text-center">Операции с лицевым счетом Абонента:</row></div>
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
<?php $itogo = 0;
    $price = 0;
    $nds = 0;
    $i = 0;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv = "cache-control" content = "no-cache">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Биллинг</title>

<!-- Bootstrap -->
<link href="media/css/bootstrap.min.css" rel="stylesheet">
<link href="media/css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
   @media print{
   .newpage{page-break-before: always;}
   } 
  </style>

</head>
<body style="font-size: 12px; font-family: Consolas">

<!--конец заголовка HTML-->

<div class="logo_sf">
    <div class="row">
        <div class="text-center">
            <div class="col-xs-2">
                <img src="/media/images/bcc_logo.png" class="img_sf">
            </div>
            <div class="col-xs-8 header_sf">
                СЧЕТ-ФАКТУРА № <?php echo "IRS-",$nomsf; ?>
                от <?php $date = explode("-", $finish);
                echo $date[0].".".$date[1].".".$date[2]; ?><br>
                согласно договора № 
                <?php $date = explode("-", $user['cdate']);
                echo $user['contract']," от ",$date[2].".".$date[1].".".$date[0]; 
                ?><br>
                <!--Период:--> 
                    <?php 
//                        $date = explode("-", $start);
//                        echo $date[0].".".$date[1].".".$date[2]; 
//                        echo " по ";
//                        $date = explode("-", $finish);
//                        echo $date[0].".".$date[1].".".$date[2]; 
//                    ?>
            </div>
            <br />
        </div>
    </div>
    <br />
    <table>
        <tr>
            <td class="odin text-right">Поставщик</td>
            <td class="dva">ООО "Amaliy Aloqalar Biznesi" TM "BCC"</td>
            <td class="tri"></td>
            <td class="odin text-right">Покупатель</td>
            <td class="dva"><?php echo $user['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Адрес</td>
            <td class="dva">100015, г.Ташкент ул.Шахрисабз, 16а 4 этаж</td>
            <td class="tri"></td>
            <td class="odin text-right">Адрес</td>
            <td class="dva"><?php echo $user['address_n'];?></td>
        </tr>
        
        
        <!--
        <tr>
            <td class="odin text-right">Телефон</td>
            <td class="dva">71 252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Телефон</td>
            <td class="dva"><?php //echo $user['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Факс</td>
            <td class="dva">71 252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Факс</td>
            <td class="dva"><?php //echo $user['fax'];?></td>
        </tr>
        -->
        <tr>
            <td class="odin text-right">Р/сч</td>
            <td class="dva">
                <?php
                    switch ($user['paymentmethod']) {
                        case 'Usd':echo '20208840103906693001';break;
                        case 'Euro':echo '20208978503906693001';break;
                        default:echo '20208000903906693001';break;
                    }
                ?>
            </td>
            <td class="tri"></td>
            <td class="odin text-right">Р/сч</td>
            <td class="dva"><?php echo $user['account_num'];?></td>
        </tr>
<!--        <tr>
            <td class="odin text-right">Банк</td>
            <td class="dva">ГОО НБ ВЭД РУ</td>
            <td class="tri"></td>
            <td class="odin text-right">Банк</td>
            <td class="dva"><?php //echo $user['bankdetails'];?></td>
        </tr>-->
        <tr>
            <td class="odin text-right">МФО</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">МФО</td>
            <td class="dva"><?php echo $user['mfo'];?></td>
        </tr>
        
        
        
        <tr>
            <td class="odin text-right">Индетификационный номер поставшика (ИНН)</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">Индетификационный номер покупатела (ИНН)</td>
            <td class="dva"><?php echo $user['inn'];?></td>
        </tr>
        <!--
        <tr>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva"><?php //echo $user['oked'];?></td>
        </tr>
        -->
        <tr>
            <td class="odin text-right">Регистрационный код поставщика НДС</td>
            <td class="dva">326010019003</td>
            <td class="tri"></td>
            <td class="odin text-right">Регистрационный код покупателя НДС</td>
            <td class="dva"><?php echo $user['rkpnds'];?></td>
        </tr>
    </table>
    <div class="row">
        Регистрационное имя пользователя: <?php echo $user['username'];?>
    </div>
    <?php $stavkands = ('n' == $user['nds']) ? $stavkands = 0 : $stavkands = $user['stavkands']; ?>
        <table class="table-print text-center sf">
            <tr>
                <td rowspan="2">№</td>
                <td rowspan="2">Наименование товаров (работ, услуг)</td>
                <td rowspan="2">Ед. изм.</td>
                <td rowspan="2">Кол-во</td>
                <td rowspan="2">Цена</td>
                <td rowspan="2">Стоимость поставки</td>
            <!--    <td colspan="2">Акцизный налог</td> -->
                <td colspan="2">НДС</td>
                <?php echo ('n' == $user["nds"])?"<td rowspan=\"2\" class=\"text-center\">Стоимость поставки без НДС</td>":
                    "<td rowspan=\"2\" class=\"text-center\">Стоимость поставки с учетом НДС</td>"; ?>
            </tr>
            <tr class="text-center">
                <!--<td>Ставка</td>
                <td>Сумма</td>-->
                <td>Ставка</td>
                <td>Сумма</td>
            </tr>
            <?php foreach ($services as $key => $value) :?>
            <?php if(0 == $value['price']){continue; } ?>
            <?php $i++ ;?>
            <tr class="sf">
                <td class="text-center sf"><?php echo $i;?></td><!-- порядковый номер -->
                <td class="text-left sf" style="width: 40%">
                    <?php echo $value['service'];?>
                </td><!-- услуга-->
                <td class="sf"><?php echo $value['unit'];?></td><!-- единица измерения-->
                <td class="text-right sf"><?php //echo $value['amount'];?></td><!--кол-во-->
                <td class="text-right sf"><?php echo number_format($value['price']*100/($stavkands+100),2,'.',','); ?></td><!--цена-->
                <td class="text-right sf">
                    <?php 
                    $price += (0 == $stavkands) ? $value['amount']*$value['price'] :
                        $value['amount']*$value['price']*100/($user['stavkands']+100);
                    echo 0 == $stavkands ? $value['amount']*$value['price'] :
                        number_format($value['amount']*$value['price']*100/($stavkands+100),2,'.',',');
                    ?>
                </td><!--стоимость поставки-->
                <!--<td  colspan="2" class="text-center sf">Без АН</td>-->
                <td class="text-center sf">
                    <?php echo ('n' == $user["nds"])?"Без НДС":$stavkands.'%';?>
                </td><!--ставка ндс-->
                <td class="text-right sf">
                    <?php 
                            $nds += $value['amount']*$value['price'] - $value['amount']*$value['price']*100/($stavkands+100);
                            echo ('n' == $user["nds"])?"Без НДС":number_format($value['amount']*$value['price'] - $value['amount']*$value['price']*100/($stavkands+100),2,'.',',');
                    ?>
                </td><!--сумма ндс-->
                <td class="text-right sf"><?php echo number_format($value['total'],2,'.',',');?></td><!--стоимость пос. с ндс-->
            </tr>
                <?php $itogo += $value['total'];?>
            <?php endforeach;?>
            <tr>
                <td class="text-center sf"><?php echo ++$i;?></td>
                <td class="text-left comment">Итого</td>
                <td>сум</td>
                <td></td>
                <td></td>
                <td class="text-right sf"><?php echo number_format($price,2,'.',',');?></td>
                <!--<td colspan="2"></td>-->
                <td><?php //echo ('n' == $user["nds"])?"Без НДС":$stavkands;?></td>
                <td class="text-right sf"><?php echo ('n' == $user["nds"])?"": number_format($nds,2,'.',',');?></td>
                <td class="text-right sf"><?php echo number_format($itogo,2,'.',','); ?></td>
            </tr>
            <tr> 
                <td colspan="9"><?php 
                    if("Usd" == $user['paymentmethod']){$valuta=2;}else{$valuta=1;}
                    $sum_prop = Model::factory('sumpropis')->num2str($itogo,$valuta);?>

                    <?php echo $sum_prop,('n' == $user["nds"])?" Без НДС ":", включая НДС ".number_format($nds,2,'.',',');?>

                </td>
            </tr>
        </table>
    <br />
    <br />
    <div class="row">
        <div class="col-xs-6">
            Руководитель ___________________<br /><br /><br />
            Главный бухгалтер ______________<br /><br /><br />
            М.П.
        </div>
        <div class="col-xs-6">
            Получил ____________________<br /><br />
            (подпись покупателя или уполномоченного представителя)<br /><br />
            ______________________________________<br />
                   (ФИО получателя)
        </div>
    </div>
</div> <!--  конец главного дива-->
<br />
<br />
<br />
<br />

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="media/js/jquery.min.js"></script>-->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!--<script src="media/js/bootstrap.min.js"></script> -->

<div class="newpage"></div>
</body>
</html>
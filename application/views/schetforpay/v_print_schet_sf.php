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
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
   @media print{
   .newpage{page-break-before: always;}
   } 
  </style>

<body style="font-size: 12px; font-family: Consolas"> 


<!--конец заголовка HTML-->
<!--*-->

<div class="logo_sf">
    <div class="row">
        <div class="text-center">
            <div class="col-xs-2">
                <img src="/media/images/bcc_logo.png" class="img_sf">
            </div>
            <div class="col-xs-8 header_sf">
            СЧЕТ № <?php echo "IP-",$nomschet; ?> от <?php echo date("d.m.Y"); ?><br>
            согласно договора № 
            <?php $date = explode("-", $user[0]['cdate']);
                echo $user[0]['contract']," от ",$date[2].".".$date[1].".".$date[0];
            ?>
            <br />
            </div>
        </div>
    </div>
    <br />
    <table>
        <tr>
            <td class="odin text-right">Поставщик</td>
            <td class="dva">ООО "Amaliy Aloqalar Biznesi" TM "BCC"</td>
            <td class="tri"></td>
            <td class="odin text-right">Получатель</td>
            <td class="dva"><?php echo $user[0]['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Адрес</td>
            <td class="dva">100015, г.Ташкент ул.Шахрисабз, 16а 4 этаж</td>
            <td class="tri"></td>
            <td class="odin text-right">Адрес</td>
            <td class="dva"><?php echo $user[0]['address_n'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Р/сч</td>
            <td class="dva">
                <?php
                    switch ($user[0]['paymentmethod']) {
                        case 'Usd':echo '20208840103906693001';break;
                        case 'Euro':echo '20208978503906693001';break;
                        default:echo '20208000903906693001';break;
                    }
                ?>
            </td>
            <td class="tri"></td>
            <td class="odin text-right">Р/сч</td>
            <td class="dva"><?php echo $user[0]['account_num'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Банк</td>
            <td class="dva">ГОО НБ ВЭД РУ</td>
            <td class="tri"></td>
            <td class="odin text-right">Банк</td>
            <td class="dva"><?php echo $user[0]['bankdetails'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">МФО</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">МФО</td>
            <td class="dva"><?php echo $user[0]['mfo'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ИНН</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">ИНН</td>
            <td class="dva"><?php echo $user[0]['inn'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ОКОНХ/ОКЭД</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">ОКОНХ/ОКЭД</td>
            <td class="dva"><?php echo $user[0]['okonx'],"/",$user[0]['oked'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Телефон</td>
            <td class="dva">71 252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Телефон</td>
            <td class="dva"><?php echo $user[0]['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Факс</td>
            <td class="dva">71 252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Факс</td>
            <td class="dva"><?php echo $user[0]['fax'];?></td>
        </tr>
    </table>
    <div class="row">
        Регистрационное имя пользователя: <?php echo $user[0]['username'];?>
    </div>
    <div class="row">
        <table style="width: 100%" class="table-print">
            <tr class="text-center">
                <td>№</td>
                <td>Наименование</td>
                <td>Дебит</td>
                <td>Кредит</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td class="comment">Сальдо на <?php echo $datebefo; ?></td>
                <?php // if(0 > $many) {$many *= -1;};?>
                <?php if(0 > $many): ?>
                    <td class="text-right sf"><?php echo number_format($many * -1,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($many,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td class="comment">Предоплата за <?php echo $month; ?></td>
                <?php if(0 > $many - $price): ?>
                    <td class="text-right sf"><?php echo number_format($price,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($price,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td class="comment">К оплате </td>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($topay,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($topay,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td class="comment">В том числе НДС</td>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($nds,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($nds,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <?php 
                        if("Usd" == $user[0]['paymentmethod']){$valuta=2;}else{$valuta=1;}
                        $sum_prop = Model::factory('sumpropis')->num2str($topay,$valuta);
                    ?>
                    <span><?php echo $sum_prop;?></span>
                </td>
            </tr>
        </table>
    </div>
    <br />
    <div class="row">
        <div class="col-xs-6">
            Директор ___________________<br /><br />
            Главный бухгалтер __________<br /><br />
            М.П.
        </div>
        <div class="col-xs-6">
            Получил ____________________<br />
            (подпись покупателя или уполномоченного представителя)<br />
            <!--По доверенности № ___ от ____________<br />-->
            ______________________________________<br />
                   (ФИО получателя)
        </div>
    </div>
</div> 

<!--  конец главного дива-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

<div class="newpage"></div>
</body>
</html>
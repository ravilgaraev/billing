<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<div class="logo_sf">
    <div class="text-center">
        СЧЕТ № <?php echo "IP-",$nomschet; ?> от <?php echo date("d.m.Y"); ?><br>
        согласно договора № 
        <?php echo $user[0]['contract']," от ",$user[0]['cdate'] ; ?><br>
    </div>
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
            <td class="dva">20208000903906693001</td>
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
        <table style="width: 100%" class="table-bordered">
            <tr class="text-center">
                <td>№</td>
                <td>Наименование</td>
                <td>Дебит</td>
                <td>Кредит</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td>Сальдо на <?php echo $datebefo; ?></td>
                <td class="text-right sf"><?php echo number_format($many,2,'.',','); ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>Предоплата за <?php echo $month; ?></td>
                <td class="text-right sf"><?php echo number_format($price,2,'.',','); ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>К оплате </td>
                <td class="text-right sf"><?php echo number_format($topay,2,'.',','); ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>В том числе НДС </td>
                <td class="text-right sf"><?php echo number_format($nds,2,'.',','); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <?php $sum_prop = Model::factory('sumpropis')->num2str($topay);?>
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
            По доверенности № ___ от ____________<br />
            ______________________________________<br />
                   (ФИО получателя)
        </div>
    </div>
</div> <!--  конец главного дива-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

<div class="newpage"></div>
</body>
</html>
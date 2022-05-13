<?php 
    $user1 = $user['u'];
?>
<!--Конец пхп инициализации--> 

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

</head>
<body style="font-size: 14px; font-family: Times New Roman">

<!--конец заголовка HTML-->

<div class="logo_sf">
    <div class="row">
        <div class="col-xs-5 text-center"><br /><br />OOO "AMALIY ALOQALAR BIZNESI"</div>
        <div class="col-xs-2 text-center"><img src="/media/images/bcc_logo.png" class="img_sf"></div>
        <div class="col-xs-5 text-center"><br /><br />"BUSINESS COMMUNICATION CENTER" LTD</div>
    </div>
    <br />
    <div class="text-center">
        СЧЕТ № <?php echo "IP-",$nomschet; ?><br>
        от <?php echo date("d.n.Y"); ?><br>
        согласно договора № <?php echo $user1[0]['contract']," от ",$user1[0]['cdate'] ; ?><br>
    </div>
    <br>
    
    <table class="table_schet">
        <tr>
            <td class="odin text-right">Поставщик</td>
            <td class="dva">"Amaliy Aloqalar Biznesi" LLC</td>
            <td class="tri"></td>
            <td class="odin text-right">Получатель</td>
            <td class="dva"><?php echo $user1[0]['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Адрес</td>
            <td class="dva">г.Ташкент, Мирабадский р-н, ул.Шахрисабз, д.16а, 4 этаж</td>
            <td class="tri"></td>
            <td class="odin text-right">Адрес</td>
            <td class="dva"><?php echo $user1[0]['address_n'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Р/сч</td>
            <td class="dva">20208000903906693001</td>
            <td class="tri"></td>
            <td class="odin text-right">Р/сч</td>
            <td class="dva"><?php echo $user1[0]['account_num'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Банк</td>
            <td class="dva">ГОО НБ ВЭД РУ</td>
            <td class="tri"></td>
            <td class="odin text-right">Банк</td>
            <td class="dva"><?php echo $user1[0]['bankdetails'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">МФО</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">МФО</td>
            <td class="dva"><?php echo $user1[0]['mfo'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ИНН</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">ИНН</td>
            <td class="dva"><?php echo $user1[0]['inn'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">ОКОНХ</td>
            <td class="dva"><?php echo $user1[0]['okonx'];?></td>
        </tr>
        <tr>
            <td class="odin text-right"></td>
            <td class="dva"></td>
            <td class="tri"></td>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva"><?php echo $user1[0]['oked'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Телефон</td>
            <td class="dva">252-66-79,252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Телефон</td>
            <td class="dva"><?php echo $user1[0]['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Факс</td>
            <td class="dva">252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Факс</td>
            <td class="dva"><?php echo $user1[0]['fax'];?></td>
        </tr>
    </table>
    <br />
    <br />

    <div class="row">
        Регистрационное имя пользователя: <?php echo $user1[0]['username'];?>
        <br />
    </div>
    <br>

    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>Наименование товаров (работ, услуг)</td>
                <td>Ед. изм.</td>
                <td>Кол-во</td>
                <td>Цена</td>
                <td>Сумма</td>
                <td>Ставка АН</td>
                <td>Сумма АН</td>
                <td>Ставка НДС</td>
                <td>Сумма НДС</td>
            </tr>
            <tr>
                <td>Предоплата за использование услуг сети Интернет</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo number_format($many,2,'.',','); ?></td>
                <td><?php echo number_format($many,2,'.',','); ?></td>
                <td colspan="2" class="text-center">Без АН</td>
                <td colspan="2" class="text-center">Без НДС</td>
            </tr>
            <tr>
                <td colspan="5">Всего к оплате (без НДС)</td>
                <td colspan="4"><?php echo number_format($many,2,'.',','); ?></td>
            </tr>
        </table>
    </div>
    
    <br />
    <span>Итого к оплате <?php echo number_format($many,2,'.',','); ?> Сум</span>
    <br />
    <?php $sum_prop = Model::factory('sumpropis')->num2str($many);?>
    <span>(<?php echo $sum_prop;?>) без НДС</span>
    <br />
    <br />
    <span>Пожалуйста, указывайте в назначении платежа номера счета и договора.</span>
    <br />
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